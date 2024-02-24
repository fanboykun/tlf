"use strict"
import "./app"

/**
 * @typedef {Object} PostList
 * @property {string} id
 * @property {string} title
 * @property {string} slug
 * @property {string} category
 * @property {string} image
 * @property {Author} author
 * @property {Detail} detail
 */

/**
 * @typedef {Object} Author
 * @property {string} uuid
 * @property {string} name
 */

/**
 * @typedef {Object} Detail
 * @property {string} date
 * @property {string} desc
 * @property {string} time
 * @property {string[]} tags
 */

/**
 * Get Auth token from cookie, then append the token to axios.defaults.headers.common['Authorization']
 * @returns {string?} authToken
 */
export const getToken = async () => {
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
        if(authToken == '') return window.location.href="/login"
        return authToken
    }
}

$(document).ready(async (e) => {
    let isClickEventRegistered = false
    /**
     * Append post data to element(s)
     * @returns {void}
     * @param {PostList[]} data
     */
    const appendData = (data) => {

        /** @type {HTMLTemplateElement} */
        const template = document.querySelector('#post-item-template')

        /** @type {HTMLDivElement} */
        const postList = $('#post-item-wrapper')

        if(!postList) return
        if(data.length == 0) return

        data.map((item, key) => {
            const i = template.content.cloneNode(true)
            if(!i) return
            i.querySelector('#post-title').textContent = item.title
            i.querySelector('#post-body').textContent = item.detail.desc
            i.querySelector('#post-image').src = item.image
            i.querySelector('#post-button').href = `/post/${item.slug}`
            postList.append(i)
        })
        registerClickEvent()
    }

    /**
     * Get/fetch posts data from backend
     * @returns {void}
     */
    const getPostsData = () => {
        axios.get('/api/post/auth/get')
            /**
             * @type {Object} res
            */
            .then(res => {
                if(res.status !== 200) return
               return appendData(res.data.data.postList)
            })
            .catch(err => {
                console.log(err)
            })
        return false; // prevent default form submit behavior.
    }

    /**
     * Show post description
     * @returns {void}
     * @param {Event} e
     */
    const showDescription = (e) => {
        e.preventDefault()
        /** @type {HTMLButtonElement} */
        const target = e.target
        const postBody = target.parentNode?.querySelector('#post-body')
        if(!postBody) return
        postBody.classList.toggle('d-none')
    }

    /**
     * Register the post element click event when posts lists has been appended to the document
     * @returns {void}
     */
    const registerClickEvent = () => {
        if(isClickEventRegistered) return
        isClickEventRegistered = true
        document.querySelectorAll('#post-button').forEach(async (element) => {
            element.addEventListener('click', showDescription)
        })
    }

    /** Get the auth token */
    const token = await getToken()
    if(token) {
        getPostsData()
    }

})
