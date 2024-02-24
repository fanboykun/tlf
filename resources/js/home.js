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
 * @property {string[]?} tags
 */

/**
 * @typedef {Object} BarePostResponseData
 * @property {{ postList: PostList[] }} data
*/

/**
 * @exports @typedef {import("axios").AxiosResponse<BarePostResponseData>} GetPostResponse
 */

/**
 * Get Auth token from cookie, then append the token to axios.defaults.headers.common['Authorization']
 * @returns {string?} authToken
 */
export const getTokenFromCookie = async (redicrectIfNull = false) => {
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
        if(authToken == '' && redicrectIfNull === true) return window.location.href = "/login"
        return authToken
    }
}

$(document).ready(async () => {
    let isClickEventRegistered = false
    /**
     * Append post data to element(s)
     * @returns {void}
     * @param {PostList[]} data
     */
    const appendData = (data) => {
        let shouldRegisterClickEvent = true

        /** @type {HTMLTemplateElement} */
        const template = document.querySelector('#post-item-template')

        /** @type {HTMLDivElement} */
        const postList = $('#post-item-wrapper')

        if(!postList) return
        if(data.length == 0) return

        data.map((item, key) => {
            const i = template.content.cloneNode(true)
            if(!i) {
                shouldRegisterClickEvent = false
                return
            }

            i.querySelector('#post-title').textContent = item.title // apply title
            i.querySelector('#post-body').textContent = item.detail.desc // apply description
            i.querySelector('#post-image').src = item.image // apply image
            i.querySelector('#post-author-name').textContent = item.author.name // apply author name
            i.querySelector('#post-category').textContent = item.category   // apply category
            i.querySelector('#post-date').textContent = item.detail.date    // apply detail date
            i.querySelector('#post-time').textContent = item.detail.time    // apply detail time

            let newAccordionId = `accordion-${key}`
            let newAccordionItemId = `item-${newAccordionId}`
            /** @type {HTMLDivElement} */ let accordionWp = i.querySelector('#accordionExample')
            /** @type {HTMLDivElement} */ let accordionItem = accordionWp.querySelector('#accrodionItem')
            /** @type {HTMLButtonElement} */ let accordionTrigger = accordionWp.querySelector('#accordionTrigger')

            // set the attributes for accordion
            accordionWp.setAttribute('id', newAccordionId)
            accordionItem.setAttribute('data-bs-parent', newAccordionId)
            accordionItem.setAttribute('id', newAccordionItemId)
            accordionTrigger.setAttribute('data-bs-target', `#${newAccordionItemId}`)


            /** @type {HTMLDivElement} */ let tagWp = i.querySelector('#tags-item-wrapper')
            /** @type {HTMLParagraphElement} */ let tagEl = tagWp.querySelector('#tag-item')
            tagWp.innerHTML = ''    // empty the innerHTML
            if(item.detail.tags.length != 0) {
                if(!tagEl) return
                item.detail.tags.map((val) => {
                    const clonedEl = tagEl.cloneNode(true)
                    clonedEl.textContent = val
                    tagWp.append(clonedEl)
                })
            }
            postList.append(i)
        })
        if(shouldRegisterClickEvent) return registerClickEvent()
    }

    /**
     * Get/fetch posts data from backend
     * @returns {Promise<void>}
     */
    const getPostsData = async() => {
        try {
            /** @type {GetPostResponse} */
            const res = await axios.get('/api/post/auth/get')
            if(res.status !== 200) {
                throw('Failed to fect data from the server')
            }
            return appendData(res.data.data.postList)
        } catch (err) {
            console.error('Failed to fect data from the server')
            console.log(err)
        }
    }

    /**
     * Register the post element click event when posts lists has been appended to the document
     * @returns {void}
     */
    const registerClickEvent = () => {
        // prevent from registering the event too many times
        if(isClickEventRegistered) return
        isClickEventRegistered = true
        $('button[id="accordionTrigger"]').each((index, element) => {
            $(element).click(function(){
                if($(element).hasClass('show')) return
                let mainItem = $(element).closest('#post-item')
                if(!mainItem) return
                $('html, body').animate({
                    scrollTop: $(mainItem).offset().top
                }, 100);
            })
        })
    }

    /** Get the auth token */
    const token = getTokenFromCookie(true)
    if(!token) {
        return window.location.href ="/login"
    }
    await getPostsData()

})
