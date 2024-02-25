import axios from 'axios';
import './bootstrap';

/** @typedef {import("axios").AxiosResponse<User>} GetMeResponse */
/** @typedef {import("axios").AxiosResponse<{message: string}>} LogOutResponse */

/**
 * @typedef {Object} User
 * @property {number} id
 * @property {string} uuid
 * @property {string} email
 * @property {Date} created_at
 * @property {Date} updated_at
 * @property {Date} email_verified_at
 */

/** Loading spinner element */
export const loadingSpinner = `<div class="d-none spinner-grow spinner-grow-sm" id="loading-spinner" role="status"><span class="visually-hidden">Loading...</span></div>`

/**
 * Get Auth token from cookie, then append the token to axios.defaults.headers.common['Authorization']
 * @param {bool} redicrectIfNull redirect if no token found
 * @param {string} redirectTo where to redirect if to token found
 * @returns {Promise<string?>} authToken
 */
export const getTokenFromCookie = async ( redicrectIfNull = false, redirectTo = "/login" ) => {
    const decodedToken = decodeURIComponent(document.cookie)
    const tokens = decodedToken.split(';')
    let authToken = ''
    if( tokens.length == 0 ) return
    if(tokens instanceof Array) {
        tokens.forEach((token) => {
            if(token.indexOf('jwt_auth') > -1 ) {
                const trimmedToken = token.split('=')
                if(trimmedToken.length != 2 ) return
                axios.defaults.headers.common['Authorization'] = `Bearer ${trimmedToken[1]}`
                authToken = trimmedToken[1]
            }
        })
        if(authToken == '' && redicrectIfNull == true) return window.location.href = redirectTo
        return authToken
    }
}

/**
 * Validate the existing auth token from cookie if it token exists
 * @param {string} token the secret token
 * @returns {Promise<string>} valiatedToken
 */
export const validateToken = async (token) => {
    let validated = false
    try {
        const res = await axios.get('/api/validateToken', {
            headers: {
                'Authorization' : `Bearer ${token}`
            }
        })
        if(res.status != 200) return validated
        return validated = res.data.authenticated
    } catch (err) {
        if( err.response.status == 401) {
            return validated
        }
    }
}

/**
 * Get current user
 * @return {Promise<User|null>}
 */
export const getMe = async() => {
    try {
        /** @type {GetMeResponse} */
        const res = await axios.post('/api/me')
        if(res.status === 200) {
            return res.data
        }
        return null
    }catch(err) {
        console.log(err)
        return null
    }
}

/**
 * Logout current authenticated user
 * @param {bool} shouldDeleteAuthHeader determine wheter to delete the axios.defaults.headers.common['Authorization'] or not
 * @returns {Promise<{message: string}|null>}
 */
export const logoutUser = async (shouldDeleteAuthHeader = false) => {
    try {
        /** @type {LogOutResponse} */
        const res = await axios.post('/api/logout')
        if(res.status != 200) return null
            if(shouldDeleteAuthHeader) {
                delete axios.defaults.headers.common['Authorization']
            }
            return res.data
    }catch(err) {
        console.log(err)
        return null
    }
}

