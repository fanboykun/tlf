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

$(document).ready((e) => {
    /** Toggle Show Password */
    let isPasswordShown = false

    /**
     * Handle the show password toggle
     * @param {Event} e
     * @returns {void}
     */
    const handleShowPassword = (e) => {
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
    }

    /** Login Form Handler
     * @returns {void}
     * @param {Event} e
    */
    const handleLoginFormSubmit = (e) => {
        e.preventDefault()

        /** @type {ValidationMessage} */
        const ValidationMessage = { email: [], password: [] }

        /** @type {RegExp} */
        const regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/

        /** @type {FormData} */
        const formData = new FormData(e.target)

        /** @type {LoginFormData} */
        const data = Object.fromEntries(formData)
        $('#submit')?.attr('disabled', true)
        $('#submit')?.append(loadingSpinner)

        /**
         * Validate the login form
         * @return bool
         */
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
         * Redirect to home page after login successfull
         * @return {void}
         * @param {AuthenticatedData} authData
         */
        const redirectToHome = (authData) => {
            console.log(authData)
            window.location.href = `/home`
        }

        /**
         * Submit the login credential
         * @return void
         */
        const submit = () => {
            axios.post('/api/login', data)
                /**
                 * @type {Object} res
                */
                .then(res => {
                    if(res.status !== 200) return
                    resetForm()
                    redirectToHome(res.data)
                })
                .catch(err => {
                    console.log(err)
                })
            return false; // prevent default form submit behavior.
        }

        /**
         * Show the form validation message if error exsist
         *  @return void
         */
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

        /**
         * Reset form input
         * @returns {void}
         */
        const resetForm = () => {
            $('#submit')?.removeAttr('disabled')
            $('#loading-spinner')?.remove()
            $('#email').val('')
            $('#password').val('')
        }

        if(!validate()) return showValidationMessage()
        return submit()
    }

    $('#showPassword').click(handleShowPassword)
    $('#loginForm').submit(handleLoginFormSubmit)
})
