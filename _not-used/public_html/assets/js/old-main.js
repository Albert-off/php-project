/* =============== PRELOADER =============== */
if (window.location.pathname === '/') {  // || window.location.pathname.includes('index.html')
    document.body.insertAdjacentHTML('afterbegin', '<div class="loader"></div>');
    window.addEventListener("load", () => {
        const loader = document.querySelector('.loader');

        loader.classList.add('loader--hidden');
        
        loader.addEventListener('transitionend', () => {
            // Make sure loader still exists in the DOM before removing it
            document.body.contains(loader) && document.body.removeChild(loader);

            // Если контент загружается быстро можно попробовать это - Задержка 2 секунды (2000 миллисекунд)
            // setTimeout(() => { if (document.body.contains(loader)) { document.body.removeChild(loader); } }, 2000);
        });
    });
}


/* =============== SHOW MENU =============== */
const showMenu = (toggleId, navId) => {
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId);
 
    toggle.addEventListener('click', () => {
        // Add show-menu class to nav menu
        nav.classList.toggle('show-menu');
 
        // Add show-icon to show and hide the menu icon
        toggle.classList.toggle('show-icon');
    });
}
 
showMenu('nav-toggle', 'nav-menu');


/* =============== CHANGE BACKGROUND HEADER =============== */
const shadowHeader = () => {
    const header = document.getElementById('header');
    
    // when the scroll is greater than 50 viewport height, 
    // add the scroll-headeer class to the header tag
    this.scrollY >= 15 ? header.classList.add('shadow-header')
                       : header.classList.remove('shadow-header');
}
window.addEventListener('scroll', shadowHeader);




/* ======== DROPDOWN ITEM/SUBITEM CLICK TO OPEN DROPDOWN MENU/SUBMENU ======== */

// opening the menu / submenu when you click on .dropdown__item / .dropdown__subitem
// and closing it when you click it again or click outside the menu.

document.addEventListener("DOMContentLoaded", function() {
    const dropdownItems = document.querySelectorAll('.dropdown__item');
    const subDropdownItems = document.querySelectorAll('.dropdown__subitem');

    dropdownItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.stopPropagation(); // предотвращает распространение события
            dropdownItems.forEach(i => {
                if (i !== item) {
                    i.classList.remove('active');
                }
            });
            item.classList.toggle('active');
        });
    });

    subDropdownItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.stopPropagation(); // предотвращает распространение события
            subDropdownItems.forEach(i => {
                if (i !== item) {
                    i.classList.remove('active');
                }
            });
            item.classList.toggle('active');
        });
    });

    document.addEventListener('click', function() {
        dropdownItems.forEach(item => {
            item.classList.remove('active');
        });
        subDropdownItems.forEach(item => {
            item.classList.remove('active');
        });
    });
});




/*=============== IMAGE SLIDER ===============*/
if (document.getElementById('carousel')) {
    //step 1: get DOM
    let nextDom = document.getElementById('next');
    let prevDom = document.getElementById('prev');

    let carouselDom = document.querySelector('.carousel');
    let SliderDom = carouselDom.querySelector('.carousel .list');
    let thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
    let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
    let timeDom = document.querySelector('.carousel .time');

    thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
    let timeRunning = 3000;
    let timeAutoNext = 14000; // 7000

    nextDom.onclick = function(){
        showSlider('next');    
    }

    prevDom.onclick = function(){
        showSlider('prev');    
    }
    let runTimeOut;
    let runNextAuto = setTimeout(() => {
        next.click();
    }, timeAutoNext)
    function showSlider(type){
        let  SliderItemsDom = SliderDom.querySelectorAll('.carousel .list .item');
        let thumbnailItemsDom = document.querySelectorAll('.carousel .thumbnail .item');
        
        if(type === 'next'){
            SliderDom.appendChild(SliderItemsDom[0]);
            thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
            carouselDom.classList.add('next');
        }else{
            SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
            thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
            carouselDom.classList.add('prev');
        }
        clearTimeout(runTimeOut);
        runTimeOut = setTimeout(() => {
            carouselDom.classList.remove('next');
            carouselDom.classList.remove('prev');
        }, timeRunning);

        clearTimeout(runNextAuto);
        runNextAuto = setTimeout(() => {
            next.click();
        }, timeAutoNext)
    }

    if (document.querySelector('.admin-pre-header')) {
        timeDom.style.top = '2rem';
    }
}



/*=============== QUESTIONS ACCORDION ===============*/
const accordionItems = document.querySelectorAll('.questions__item');

accordionItems.forEach((item) => {
    const accordionHeader = item.querySelector('.questions__header');

    accordionHeader.addEventListener('click', () => {
        const openItem = document.querySelector('.accordion-open');

        toggleItem(item)

        if (openItem && openItem !== item) {
            toggleItem(openItem)
        }
    })
})

const toggleItem = (item) => {
    const accordionContent = item.querySelector('.questions__content');

    if (item.classList.contains('accordion-open')) {
        accordionContent.removeAttribute('style')
        item.classList.remove('accordion-open')
    } else {
        accordionContent.style.height = accordionContent.scrollHeight + 'px'
        item.classList.add('accordion-open')
    }
}




/*=============== ESTIMATE FORM DATE / TIME / SELECT / TEXTAREA ===============*/
// ---- DATE ----
const contactDate = document.getElementById('date');
today = new Date().toISOString().split('T')[0];
contactDate.setAttribute('min', today);

contactDate.addEventListener("click", e => {
    contactDate.showPicker(); // mehod that open calendar
});

contactDate.addEventListener('change', function() { 
    if (this.value === "") { 
        this.style.color = '#707070'; 
    } else { 
        this.style.color = '#000'; 
    } 
});


// ---- TIME ---- (not used)
// const contactTime = document.getElementById('time');

// contactTime.addEventListener("click", e => {
//     contactTime.showPicker(); // method that open time
// });


// ---- SELECT ----
const selectElements = document.querySelectorAll('#estimate-form select'); 

selectElements.forEach(select => {
    select.addEventListener('change', function() { 
        if (this.value === "") { 
            this.style.color = '#707070'; 
        } else { 
            this.style.color = '#000'; 
        } 
    });
});


// ---- TEXTAREA ----
const contactTextarea = document.getElementById('comments');

contactTextarea.addEventListener("keyup", e => {
    contactTextarea.style.height = "4rem";
    let scHeight = e.target.scrollHeight;
    contactTextarea.style.height = `${scHeight}px`;
});




/*=============== REQUEST AN ESTIMATE FORM VALIDATION ===============*/
const form = document.getElementById('estimate-form');
const firstname = document.getElementById('first-name');
const lastname = document.getElementById('last-name');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const postalCode = document.getElementById('postal-code');


form.addEventListener('submit', e => {
    e.preventDefault();

    if (validateRequestAnEstimateForm()) {
        showFormSuccessToast();
        temporarilyDisableSubmitButton()

        /* ----======== MESSAGE SENDING PROCESS ========---- */
        // statusTxt.style.color = "#0D6EFD";
        // statusTxt.style.display = "block";

        let xhr = new XMLHttpRequest();  // creating new xml object
        xhr.open("POST", "/send-email.php", true);  // sending post request to message.php file
        // xhr.onload = () => {  // once ajax loaded
        //     if (xhr.readyState == 4 && xhr.status == 200) {  // if ajax response status is 200 & ready status is 4 means there is no any error
        //         let response = xhr.response;  // storing ajax response in a response variable
        //         // if response is an error like enter valid email address then we'll change status color to red else reset the form
        //         if (response.indexOf("Email and Phone field is required!") != -1 
        //         || response.indexOf("Enter a valid email address!")
        //         || response.indexOf("Sorry, failed to send your message!")) {
        //             // statusTxt.style.color = "red";
        //         } else {
        //             form.reset();
        //             setTimeout(() => {
        //                 statusTxt.style.display = "none";
        //             }, 3000);  // hide the statusTxt after 3 seconds if the msg is sent
        //         }
        //         // statusTxt.innerText = response;

        //         // console.log(response);
        //     }
        // }

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                console.log('Success:', xhr.responseText);
            } else {
                console.log('Error:', xhr.status, xhr.statusText);
            }
        };
        
        xhr.onerror = function() {
            console.log('Request failed');
        };

        let formData = new FormData(form);  // creating new FormData obj. This obj is used to send form data
        xhr.send(formData);  // sending form data
    }
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.estimate-form__error-message');

    errorDisplay.innerText = message;
    inputControl.classList.add('estimate-form__error-message');
    inputControl.classList.remove('estimate-form__success');
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.estimate-form__error-message');

    errorDisplay.innerText = '';
    inputControl.classList.add('estimate-form__success');
    inputControl.classList.remove('estimate-form__error-message');
}

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validateRequestAnEstimateForm() {
    let isValid = true;

    const firstnameValue = firstname.value.trim();
    const lastnameValue = lastname.value.trim();
    const emailValue = email.value.trim();
    const phoneValue = phone.value.trim();
    const postalCodeValue = postalCode.value.trim();

    if (firstnameValue === '') {
        setError(firstname, 'First Name is required');
        isValid = false;
    } else if (firstnameValue.length < 2) {
        setError(firstname, 'Please enter correct First Name');
        isValid = false;
    } else {
        setSuccess(firstname);
    }

    if (lastnameValue === '') {
        setError(lastname, 'Last Name is required');
        isValid = false;
    } else if (lastnameValue.length < 3) {
        setError(lastname, 'Please enter correct Last Name');
        isValid = false;
    } else {
        setSuccess(lastname);
    }

    if (emailValue === '') {
        setError(email, 'Email is required');
        isValid = false;
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address')
        isValid = false;
    } else {
        setSuccess(email);
    }

    if (phoneValue === '') {
        setError(phone, 'Phone is required');
        isValid = false;
    } else if (phoneValue.length < 8) {
        setError(phone, 'Please enter correct Phone');
        isValid = false;
    } else {
        setSuccess(phone);
    }

    if (postalCodeValue === '') {
        setError(postalCode, 'Postal Code is required');
        isValid = false;
    } else if (postalCodeValue.length < 3) {
        setError(postalCode, 'Please enter correct Postal Code');
        isValid = false;
    } else {
        setSuccess(postalCode);
    }

    return isValid;
}


// FORM TOAST NOTIFICATION
let formToastNotActive = true;
function showFormSuccessToast() {
    if (formToastNotActive) {
        formToastNotActive = false;

        const formToastNotification = `
            <div class="form-toast">
                <div class="form-toast__content">
                    <i class="ri-check-line form-toast__succes-icon"></i>
                    <div class="form-toast__message">
                        <h3>Message sended</h3>
                        <p>Message sent successfully!</p>
                    </div>
                </div>
                <i class="ri-close-line form-toast__close-icon"></i>
            </div>
        `;

        // <p>We will contact you shortly!</p>

        document.body.insertAdjacentHTML('afterbegin', formToastNotification);

        const formToast = document.querySelector('.form-toast');
        const closeFormToastNotification = document.querySelector('.form-toast__close-icon');

        setTimeout(() => {
            formToast.classList.add("active");
        });

        // remove formToast using close icon
        closeFormToastNotification.addEventListener('click', () => {
            formToast.classList.remove("active");

            setTimeout(() => {
                formToastNotActive = true;
                formToast.remove();
            }, 600);
        });

        // remove formToast after animationend
        formToast.addEventListener('animationend', () => {
            formToast.classList.remove("active");

            setTimeout(() => {
                formToastNotActive = true;
                formToast.remove();
            }, 600);
        });
    }
}


function temporarilyDisableSubmitButton() {
    const submitBtn = document.getElementById('estimate-submit-button');
    submitBtn.disabled = true;
    submitBtn.style.opacity = .5;
    submitBtn.style.pointerEvents = 'none';

    setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.style.opacity = 1;
        submitBtn.style.pointerEvents = 'initial';
    }, 6000);
}


// const submitBtn = document.getElementById('estimate-submit-button');
// form.addEventListener('submit', function() {
//     console.log('btn submited');
// });





/*=============== SCROLL REVEAL ANIMATION ===============*/
const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2500,
    delay: 400,
    // reset: true 
})

// sr.reveal(`.home__data`)
// sr.reveal(`.home__picture`, {delay: 500})
// sr.reveal(`.home__social`, {delay: 600})

sr.reveal(`.contact__box`, {origin: 'left'})
sr.reveal(`.estimate-form`, {origin: 'right'})
sr.reveal(`.product__btn`, {origin: 'left'})
sr.reveal(`.feature__content-1`, {origin: 'left'})
sr.reveal(`.feature__content-2`, {origin: 'right'})
sr.reveal(`.product__card, .questions__group, .footer`, {interval: 100})
