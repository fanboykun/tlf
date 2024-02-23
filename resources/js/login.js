"use strict"
import { loadingSpinner } from "./app"
/**
 * Login Form Object Type
 * @typedef {Object} LoginFormData
 * @property {string} email
 * @property {string} password
*/

/**
 * Validation Message Object Type
 * @typedef {Object} ValidationMessage
 * @property {string[]} email
 * @property {string[]} password
*/

/**
 * Authenticated Data Payload
 * @typedef {Object} AuthenticatedData
 * @property {string} access_token
 * @property {string} expires_in
 * @property {string} token_type
 */

window.addEventListener('DOMContentLoaded', () => {
    /** Toggle Show Password */
    let isPasswordShown = false
    $('#showPassword').click(() => {
        isPasswordShown = !isPasswordShown
        if(isPasswordShown) {
            $('input[name="password"]').attr('type', 'text')
            $('#hidePasswordIcon').removeClass('d-none')
            $('#showPasswordIcon').addClass('d-none')
        }else {
            $('input[name="password"]').attr('type', 'password')
            $('#showPasswordIcon').removeClass('d-none')
            $('#hidePasswordIcon').addClass('d-none')
        }
    })

    /** Login Form Handler */
    $('#loginForm').submit((e) => {
        e.preventDefault()
        /** @type {ValidationMessage} */
        const ValidationMessage = { email: [], password: [] }
        const regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
        const formData = new FormData(e.target)

        /** @type {LoginFormData} */
        const data = Object.fromEntries(formData)
        $('#submit')?.attr('disabled', true)
        $('#submit')?.append(loadingSpinner)

        /** @return bool */
        const validate = () => {
            let validated = true
            if(data.email === '') {
                ValidationMessage.email.push('Email is required')
                validated = false
            }
            if(data.password === ''){
                ValidationMessage.password.push('Password is required')
                validated = false
            }
            if(!data.email.match(regexEmail)) {
                ValidationMessage.email.push('Invalid email')
                validated = false
            }
            return validated
        }

        /**
         * @return {void}
         * @param {AuthenticatedData} authData
         */
        const redirectToHome = (authData) => {
            console.log(authData)
            window.location.href = `/home`
        }

        /** @return void */
        const submit = () => {
            axios.post('/api/login', data)
                /**
                 * @type {Object} res
                */
                .then(res => {
                    if(res.status !== 200) return
                    $('#submit')?.removeAttr('disabled')
                    $('#loading-spinner')?.remove()
                    redirectToHome(res.data)
                })
                .catch(err => {
                    console.log(err)
                })
            return false; // prevent default form submit behavior.
        }

        /** @return void */
        const showValidationMessage = () => {
            $('#submit')?.removeAttr('disabled')
            $('#loading-spinner')?.remove()
            Object.entries(ValidationMessage).forEach(([key, value]) => {
                if(value.length >=1 ) {
                    $(`#${key}Error`).html('')
                    value.forEach((v) => {
                        $(`#${key}Error`).append(`<li>${v}</li>`)
                    })
                }
            })
        }

        if(!validate()) return showValidationMessage()
        return submit()

    })
})
