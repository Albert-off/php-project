'use strict';


class Preloader {
    constructor(loaderId) {
        this.loader = document.getElementById(loaderId);
        if (!this.loader) return;
        
        this.cookieMaxAge = 60 * 60 * 24 * 7; // 7 days in seconds
        this.init();
    }

    init() {
        window.addEventListener("load", () => {
            // 1. Smoothly hide the preloader
            this.loader.classList.add('loader--hidden');

            // 2. Set a cookie so the preloader won’t bother again (for 7 days)
            // path=/ means the cookie is valid for the entire site, not just the current page
            document.cookie = `site_visited=true; max-age=${this.cookieMaxAge}; path=/; SameSite=Lax`;

            // 3. Remove from DOM after the transition animation finishes
            this.loader.addEventListener('transitionend', () => this.loader.remove(), { once: true });
        });
    }
}


class Header {
    constructor(config) {
        this.header = document.querySelector(config.headerSelector);
        this.toggle = document.querySelector(config.toggleSelector);
        this.nav = document.querySelector(config.navSelector);

        if (!this.header || !this.toggle || !this.nav) return;

        this.dropdownItems = this.nav.querySelectorAll(config.dropdownSelector);
        this.subDropdownItems = this.nav.querySelectorAll(config.subDropdownSelector);
        
        this.ticking = false;

        this.init();
    }

    init() {
        this.onScroll();
        this.onMenuToggle();

        // Запускаем только если элементы физически есть на странице
        if (this.dropdownItems.length > 0) this.onDropdownClick();
        if (this.subDropdownItems.length > 0) this.onSubDropdownClick();

        this.onOutsideClick();
    }

    onScroll() {
        window.addEventListener('scroll', () => {
            if (!this.ticking) {
                window.requestAnimationFrame(() => {
                    // Add or remove the shadow-header class to the header element when the scroll is greater than 15px
                    if (window.scrollY >= 15) this.header.classList.add('shadow-header');
                    else this.header.classList.remove('shadow-header');

                    this.ticking = false;
                });
                this.ticking = true;
            }
        }, { passive: true }); // passive: true повышает производительность скролла в 2026 году

        // { passive: true } на Scroll Listener: Сообщает браузеру, что обработчик не будет отменять прокрутку (event.preventDefault()). 
        // Это гарантирует плавность FPS на мобильных устройствах, убирая микро-фризы.
    }

    onMenuToggle() {
        this.toggle.addEventListener('click', () => {
            // Add show-menu class to nav menu
            this.nav.classList.toggle('show-menu');
            // Add show-icon to show and hide the menu icon
            this.toggle.classList.toggle('show-icon');

            // Практика 2026: Управление доступностью для скринридеров
            const isExpanded = this.toggle.classList.contains('show-icon');
            this.toggle.setAttribute('aria-expanded', isExpanded);
        });
    }


    // opening the menu / submenu when you click on .dropdown__item / .dropdown__subitem
    // and closing it when you click it again or click outside the menu.
    
    onDropdownClick() {
        this.dropdownItems.forEach(item => {
            item.addEventListener('click', (event) => {
                event.stopPropagation();

                // Закрываем другие открытые dropdown-ы первого уровня
                this.dropdownItems.forEach(i => {
                    if (i !== item) i.classList.remove('active');
                });
                
                item.classList.toggle('active');
            });
        });    
    }

    onSubDropdownClick() {
        this.subDropdownItems.forEach(item => {
            item.addEventListener('click', (event) => {
                event.stopPropagation(); // Не дает закрыться верхнему уровню menu предотвращая распространения события

                this.subDropdownItems.forEach(i => {
                    if (i !== item) i.classList.remove('active');
                });

                item.classList.toggle('active');
            });
        });
    }

    onOutsideClick() {
        document.addEventListener('click', () => {
            this.dropdownItems.forEach(item => item.classList.remove('active'));
            this.subDropdownItems.forEach(item => item.classList.remove('active'));
        });    
    }
}


class Carousel {
    constructor(carouselId) {
        this.carousel = document.getElementById(carouselId);
        if (!this.carousel) return;

        // Инициализация DOM-элементов
        this.nextBtn = document.getElementById('next');
        this.prevBtn = document.getElementById('prev');
        this.list = this.carousel.querySelector('.carousel__list');
        this.thumbBorder = this.carousel.querySelector('.carousel__thumbnails');
        this.timeDom = this.carousel.querySelector('.carousel__time');
        // this.adminHeader = document.querySelector('.admin-pre-header');

        // Константы таймингов
        this.timeRunning = 3000;
        this.timeAutoNext = 14000;

        // Таймеры
        this.runTimeOut = null;
        this.runNextAuto = null;

        this.init();
    }

    /**
     * Запуск карусели и навешивание событий
     */
    init() {
        // Подготовка первого элемента миниатюр
        const thumbItems = this.thumbBorder?.querySelectorAll('.carousel__thumb-item');
        if (thumbItems && thumbItems.length > 0) {
            this.thumbBorder.appendChild(thumbItems[0]);
        }

        // Адаптация под админ-панель
        // if (this.adminHeader && this.timeDom) {
        //     this.timeDom.style.top = '2rem';
        // }

        // Регистрация обработчиков событий (addEventListener)
        this.nextBtn?.addEventListener('click', () => this.showSlider('next'));
        this.prevBtn?.addEventListener('click', () => this.showSlider('prev'));

        // Старт авто-прокрутки
        this.startAutoNext();
    }

    /**
     * Основной метод переключения слайдов
     * @param {('next'|'prev')} type 
     */
    showSlider(type) {
        const sliderItems = this.list?.querySelectorAll('.carousel__item');
        const thumbItems = this.thumbBorder?.querySelectorAll('.carousel__thumb-item');

        if (!sliderItems?.length || !thumbItems?.length) return;

        if (type === 'next') {
            // Перемещаем первый слайд в конец
            this.list.appendChild(sliderItems[0]);
            this.thumbBorder.appendChild(thumbItems[0]);
            
            this.carousel.classList.remove('carousel--prev');
            this.carousel.classList.add('carousel--next');
        } else {
            // Перемещаем последний слайд в начало
            this.list.prepend(sliderItems[sliderItems.length - 1]);
            this.thumbBorder.prepend(thumbItems[thumbItems.length - 1]);
            
            this.carousel.classList.remove('carousel--next');
            this.carousel.classList.add('carousel--prev');
        }

        // Сброс классов анимации по завершении
        clearTimeout(this.runTimeOut);
        this.runTimeOut = setTimeout(() => {
            this.carousel.classList.remove('carousel--next', 'carousel--prev');
        }, this.timeRunning);

        // Перезапуск авто-прокрутки после ручного клика
        this.startAutoNext();
    }

    /**
     * Запуск/сброс таймера автоматического перехода к следующему слайду
     */
    startAutoNext() {
        clearTimeout(this.runNextAuto);
        this.runNextAuto = setTimeout(() => {
            this.nextBtn?.click();
        }, this.timeAutoNext);
    }
}


class BackgroundRandomizer {
    constructor(selector) {
        this.element = document.querySelector(selector);
        if (!this.element) return;

        this.baseUrl = this.element.dataset.baseUrl || "/";
        this.path = this.element.dataset.bgPath;

        const countValue = Number(this.element.dataset.bgCount);
        this.count = Number.isInteger(countValue) && countValue > 0 ? countValue : 0;

        if (!this.path || !this.count) return;

        this.init();
    }

    #getRandomNumber() {
        return Math.floor(Math.random() * this.count) + 1;
    }

    #getImageUrl() {
        return `${this.baseUrl}${this.path}-${this.#getRandomNumber()}.avif`;
    }

    init() {
        this.element.style.backgroundImage = `url("${this.#getImageUrl()}")`;
    }
}


class EstimateForm {
    static MIN_FIRST_NAME_LENGTH = 2;
    static MIN_LAST_NAME_LENGTH = 3;
    static PHONE_NUMBER_LENGTH = 10;
    static EMAIL_REGEX = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    static SUBMIT_DELAY = 6000;

    constructor(formId) {
        this.form = document.getElementById(formId);
        if (!this.form) return;

        this.fields = {
            firstName: this.form.querySelector('#first-name'),
            lastName: this.form.querySelector('#last-name'),
            email: this.form.querySelector('#email'),
            phone: this.form.querySelector('#phone'),
            postalCode: this.form.querySelector('#postal-code'),
            location: this.form.querySelector('#location'),
            preferredTime: this.form.querySelector('#time')
        };

        this.dateInput = document.getElementById('date');
        this.selects = this.form.querySelectorAll('select');
        this.textarea = document.getElementById('comments');
        this.submit = document.getElementById('estimate-submit-button');
        this.toastActive = false;

        this.toast = new Toast();

        this.init();
    }

    init() {
        this.setupDate();
        this.setupSelects();
        this.setupTextarea();
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    updateFilledState(element) {
        element.classList.toggle('filled', element.value !== '');
    }

    setupDate() {
        if (!this.dateInput) return;

        const today = new Date().toISOString().split('T')[0];
        this.dateInput.setAttribute('min', today);

        this.dateInput.addEventListener('click', () => this.dateInput.showPicker());
        this.dateInput.addEventListener('change', ({ currentTarget }) => {
            this.updateFilledState(currentTarget);
        });
    }

    setupSelects() {
        this.selects.forEach(select => {
            select.addEventListener('change', ({ currentTarget }) => {
                this.updateFilledState(currentTarget);
            });
        })
    }

    setupTextarea() {
        if (!this.textarea) return;

        this.textarea.addEventListener('input', ({ currentTarget }) => {
            this.resizeTextarea(currentTarget);
        });
    }

    resizeTextarea(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = `${textarea.scrollHeight}px`
    }

    setError(element, message) {
        const formField = element.closest('.form-field');
        if (!formField) return;

        formField.classList.remove('success');
        formField.classList.add('error');

        const errorElement = formField.querySelector('.form-field__error');
        if (errorElement) errorElement.textContent = message;
        
        return false;
    }

    setSuccess(element) {
        const formField = element.closest('.form-field');
        if (!formField) return;

        formField.classList.remove('error');
        formField.classList.add('success');

        const errorElement = formField.querySelector('.form-field__error');
        if (errorElement) errorElement.textContent = '';
    }

    isValidEmail(email) {
        return EstimateForm.EMAIL_REGEX.test(email.toLowerCase());
    }

    validateFirstName() {
        const { firstName } = this.fields;
        if (!firstName) return false;

        const value = firstName.value.trim();

        if (!value) {
            return this.setError(
                firstName,
                'First Name is required'
            );
        }

        if (value.length < EstimateForm.MIN_FIRST_NAME_LENGTH) {
            return this.setError(
                firstName,
                'Please enter correct First Name'
            );
        }

        this.setSuccess(firstName);
        return true;
    }

    validateLastName() {
        const { lastName } = this.fields;
        if (!lastName) return false;

        const value = lastName.value.trim();

        if (!value) {
            return this.setError(
                lastName,
                'Last Name is required'
            );
        }

        if (value.length < EstimateForm.MIN_LAST_NAME_LENGTH) {
            return this.setError(
                lastName,
                'Please enter correct Last Name'
            );
        }

        this.setSuccess(lastName);
        return true;
    }

    validateEmail() {
        const { email } = this.fields;
        if (!email) return false;

        const value = email.value.trim();

        if (!value) {
            return this.setError(
                email,
                'Email is required'
            );
        }

        if (!this.isValidEmail(value)) {
            return this.setError(
                email,
                'Provide a valid Email address'
            );
        }

        this.setSuccess(email);
        return true;
    }

    validatePhone() {
        const { phone } = this.fields;
        if (!phone) return false;

        const value = phone.value.trim();

        if (!value) {
            return this.setError(
                phone,
                'Phone number is required'
            );
        }

        if (value.length !== EstimateForm.PHONE_NUMBER_LENGTH) {
            return this.setError(
                phone,
                'Please enter correct Phone number'
            );
        }

        this.setSuccess(phone);
        return true;
    }

    validatePostalCode() {
        const { postalCode } = this.fields;
        if (!postalCode) return false;

        const value = postalCode.value.trim();

        if (!value) {
            return this.setError(
                postalCode,
                'Postal Code is required'
            );
        }

        if (value.length < 3) {
            return this.setError(
                postalCode,
                'Please enter correct Postal Code'
            );
        }

        this.setSuccess(postalCode);
        return true;
    }

    validate() {
        return [
            this.validateFirstName(),
            this.validateLastName(),
            this.validateEmail(),
            this.validatePhone(),
            this.validatePostalCode()
        ].every(Boolean);
    }

    setSubmitDisabled(disabled) {
        this.submit.disabled = disabled;
        this.submit.classList.toggle('is-disabled', disabled);

        // if (!disabled) return;

        // setTimeout(() => {
        //     this.setSubmitDisabled(false), 
        //     EstimateForm.SUBMIT_DELAY
        // });
    }

    async send() {
        const response = await fetch('/estimate', {
            method: 'POST',
            body: new FormData(this.form)
        });

        if (response.ok) {
            console.log('Success:', await response.text());
        } else {
            console.error('Server error:', response.status);
            throw new Error(
                `Server returned ${response.status}`
            );
        }
    }

    async handleSubmit(e) {
        e.preventDefault();
        if (!this.submit) return;
        if (!this.validate()) return;

        this.setSubmitDisabled(true);

        try {
            this.testSendData();
            // await this.send();
            
            this.form.reset();
            this.updateFilledState(this.dateInput);
            this.updateFilledState(this.fields.location);
            this.updateFilledState(this.fields.preferredTime);

            this.toast.success({
                title: 'Message sent',
                message: 'Message sent successfully.'
            });
        } catch (error) {
            console.error('Network error:', error);
            this.toast.error({
                title: 'Error',
                message: 'Unable to send message.'
            });
        } finally {
            this.setSubmitDisabled(false);
        }
    }

    testSendData() {
       const formData = new FormData(this.form);
        /* const data = {};

        for (const [key, value] of fd.entries()) {
            if (key in data) {
                if (!Array.isArray(data[key])) {
                    data[key] = [data[key]];
                }
                data[key].push(value);
            } else {
                data[key] = value;
            }
        } */

        // Современный и быстрый способ собрать плоский объект из FormData
        const data = Object.fromEntries(formData);

        // Так как Object.fromEntries берет только последнее значение для дублирующихся ключей,
        // мы точечно перезаписываем массив продуктов правильным методом .getAll()
        if (formData.has('products[]')) {
            data['products[]'] = formData.getAll('products[]');
        }

        console.log(data);
    }
}


class Toast {
    constructor() {
        this.toast = null;
        this.closeBtn = null;
        this.autoCloseTimeout = null;
    }

    success({ title, message }) {
        this.#show({
            type: 'success',
            icon: 'ri-check-line',
            title,
            message
        });
    }

    error({ title, message }) {
        this.#show({
            type: 'error',
            icon: 'ri-error-warning-line',
            title,
            message
        });
    }

    #show({ type, icon, title, message }) {
        // 1. Удаляем предыдущий тост, если он есть
        this.#removeImmediate();

        // 2. Создаем разметку и DOM-элемент
        const html = this.#createMarkup({ type, icon, title, message });

        const wrapper = document.createElement('div');
        wrapper.innerHTML = html.trim();
        this.toast = wrapper.firstElementChild;

        // 3. Вставляем в DOM
        document.body.prepend(this.toast);

        // 4. Находим кнопку закрытия
        this.closeBtn = this.toast.querySelector('.toast__close-icon');

        // 5. Навешиваем события
        this.closeBtn.addEventListener('click', () => this.remove());

        // 6. Запускаем анимацию появления на следующем кадре анимации
        requestAnimationFrame(() => {
            if (this.toast) this.toast.classList.add('active');
        });

        // 7. Автоматическое удаление по истечении времени прогресс-бара (6 секунд из вашего CSS)
        this.autoCloseTimeout = setTimeout(() => {
            this.remove();
        }, 6000);
    }

    // Генерация HTML-строки
    #createMarkup({ type, icon, title, message }) {
        return `
            <div class="toast toast--${type}">
                <div class="toast__content">
                    <i class="${icon} toast__icon"></i>
                    <div class="toast__message">
                        <h3>${title}</h3>
                        <p>${message}</p>
                    </div>
                </div>
                <i class="ri-close-line toast__close-icon"></i>
            </div>
        `;
    }

    // Плавное удаление с анимацией
    remove() {
        if (!this.toast) return;

        // Очищаем таймер автозакрытия, если пользователь закрыл вручную
        clearTimeout(this.autoCloseTimeout);

        this.toast.classList.remove('active');

        // Ждем завершения CSS-перехода (в вашем CSS transition: 0.5s)
        setTimeout(() => {
            this.#removeImmediate();
        }, 500);
    }

    // Моментальное жесткое удаление из DOM (для очистки перед показом нового)
    #removeImmediate() {
        if (this.toast) {
            this.toast.remove();
        }
        clearTimeout(this.autoCloseTimeout);
        this.toast = null;
        this.closeBtn = null;
        this.autoCloseTimeout = null;
    }
}

/*
Что изменилось к лучшему?
- Предсказуемость: Вызов new Toast() теперь безопасен и ничего не рендерит заранее.

- Точечное управление DOM: Метод wrapper.firstElementChild гарантирует, что мы сохранили ссылку на «наш» элемент, даже если на странице запущено несколько процессов.

- Отсутствие багов с наслоением: Функция #removeImmediate моментально стирает старый тост, если новый вызвался до того, как закончилась анимация скрытия старого.

- Универсальность темы: Стили полностью вынесены в CSS-модификаторы, JS занимается исключительно логикой и данными.
*/


document.addEventListener("DOMContentLoaded", () => {

    // /* =============== PRELOADER =============== */
    // (() => {
    //     // Looking for the preloader on the page (it will only exist if PHP output it)
    //     const loader = document.getElementById('page-preloader');
    //     if (!loader) return;

    //     const COOKIE_MAX_AGE = 60 * 60 * 24 * 7; // 7 days in seconds

    //     window.addEventListener("load", () => {
    //         // 1. Smoothly hide the preloader
    //         loader.classList.add('loader--hidden');

    //         // 2. Set a cookie so the preloader won’t bother again (for 7 days)
    //         // path=/ means the cookie is valid for the entire site, not just the current page
    //         document.cookie = `site_visited=true; max-age=${COOKIE_MAX_AGE}; path=/; SameSite=Lax`;

    //         // 3. Remove from DOM after the transition animation finishes
    //         loader.addEventListener('transitionend', () => loader.remove(), { once: true });
    //     });
    // })();



    // /* =============== SHOW MENU =============== */
    // const showMenu = (toggleId, navId) => {
    //     const toggle = document.getElementById(toggleId);
    //     const nav = document.getElementById(navId);

    //     if (!toggle || !nav) return;

    //     toggle.addEventListener('click', () => {
    //         // Add show-menu class to nav menu
    //         nav.classList.toggle('show-menu');

    //         // Add show-icon to show and hide the menu icon
    //         toggle.classList.toggle('show-icon');
    //     });
    // };
    // showMenu('nav-toggle', 'nav-menu');



    // /* =============== SHOW HEADER SHADOW =============== */
    // const header = document.getElementById('header');
    // if (header) {
    //     let ticking = false;

    //     window.addEventListener('scroll', () => {
    //         if (!ticking) {
    //             window.requestAnimationFrame(() => {
    //                 // when the scroll is greater than 50 viewport height, 
    //                 // add the scroll-headeer class to the header tag
    //                 if (window.scrollY >= 15) header.classList.add('shadow-header');
    //                 else header.classList.remove('shadow-header');

    //                 ticking = false;
    //             });
    //             ticking = true;
    //         }
    //     });
    // }



    // /* ======== DROPDOWN ITEM/SUBITEM CLICK TO OPEN DROPDOWN MENU/SUBMENU ======== */

    // // opening the menu / submenu when you click on .dropdown__item / .dropdown__subitem
    // // and closing it when you click it again or click outside the menu.

    // /*     
    // document.addEventListener('click', (event) => {
    //     const dropdownItem = event.target.closest('.dropdown__item');
    //     const subDropdownItem = event.target.closest('.dropdown__subitem')

    //     // Если клик по главному дропдауну
    //     if (dropdownItem) {
    //         event.stopPropagation(); // предотвращает распространение события
    //         document.querySelectorAll('.dropdown__item').forEach(i => {
    //             if (i !== dropdownItem) i.classList.remove('active');
    //         });
    //         dropdownItem.classList.toggle('active');
    //         return;
    //     }

    //     // Если клик по суб-дропдауну
    //     if (subDropdownItem) {
    //         event.stopPropagation(); // предотвращает распространение события
    //         document.querySelectorAll('.dropdown__subitem').forEach(i => {
    //             if (i !== subDropdownItem) i.classList.remove('active');
    //         });
    //         subDropdownItem.classList.toggle('active');
    //         return;
    //     }

    //     // Клик вне меню — закрываем всё
    //     document.querySelectorAll('.dropdown__item, .dropdown__subitem').forEach(item => {
    //         item.classList.remove('active');
    //     });
    // }); 
    // */

    // const dropdownItems = document.querySelectorAll('.dropdown__item');
    // const subDropdownItems = document.querySelectorAll('.dropdown__subitem');

    // dropdownItems.forEach(item => {
    //     item.addEventListener('click', function(event) {
    //         event.stopPropagation(); // предотвращает распространение события
    //         dropdownItems.forEach(i => {
    //             if (i !== item) {
    //                 i.classList.remove('active');
    //             }
    //         });
    //         item.classList.toggle('active');
    //     });
    // });

    // subDropdownItems.forEach(item => {
    //     item.addEventListener('click', function(event) {
    //         event.stopPropagation(); // предотвращает распространение события
    //         subDropdownItems.forEach(i => {
    //             if (i !== item) {
    //                 i.classList.remove('active');
    //             }
    //         });
    //         item.classList.toggle('active');
    //     });
    // });

    // document.addEventListener('click', function() {
    //     dropdownItems.forEach(item => {
    //         item.classList.remove('active');
    //     });
    //     subDropdownItems.forEach(item => {
    //         item.classList.remove('active');
    //     });
    // });


    /*=============== IMAGE SLIDER ===============*/
    /*
    const carousel = document.getElementById('carousel');
    if (carousel) {
        const nextDom = document.getElementById('next');
        const prevDom = document.getElementById('prev');
        const sliderDom = carousel.querySelector('.list');
        const thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
        const timeDom = document.querySelector('.carousel .time');

        if (sliderDom && thumbnailBorderDom) {
            let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
            if (thumbnailItemsDom.length > 0) {
                thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
            }

            const timeRunning = 3000;
            const timeAutoNext = 14000;
            let runTimeOut;

            // Исправлено: современный нативный клик через Event Listener
            let runNextAuto = setTimeout(() => nextDom?.click(), timeAutoNext);

            const showSlider = (type) => {
                const sliderItemsDom = sliderDom.querySelectorAll('.item');
                const currentThumbnails = thumbnailBorderDom.querySelectorAll('.item');

                if (type === 'next') {
                    sliderDom.appendChild(sliderItemsDom[0]);
                    thumbnailBorderDom.appendChild(currentThumbnails[0]);
                    carousel.classList.add('next');
                } else {
                    sliderDom.prepend(sliderItemsDom[sliderItemsDom.length - 1]);
                    thumbnailBorderDom.prepend(currentThumbnails[currentThumbnails.length - 1]);
                    carousel.classList.add('prev');
                }

                clearTimeout(runTimeOut);
                runTimeOut = setTimeout(() => {
                    carousel.classList.remove('next', 'prev');
                }, timeRunning);

                clearTimeout(runNextAuto);
                runNextAuto = setTimeout(() => nextDom?.click(), timeAutoNext);
            };

            nextDom?.addEventListener('click', () => showSlider('next'));
            prevDom?.addEventListener('click', () => showSlider('prev'));

            if (document.querySelector('.admin-pre-header') && timeDom) {
                timeDom.style.top = '2rem';
            }
        }
    }
    */

    /*
    if (document.getElementById('carousel')) {
        const nextDom = document.getElementById('next');
        const prevDom = document.getElementById('prev');

        const carouselDom = document.querySelector('.carousel');
        const SliderDom = carouselDom.querySelector('.carousel__list');
        const thumbnailBorderDom = document.querySelector('.carousel__thumbnails');
        const timeDom = document.querySelector('.carousel__time');

        let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.carousel__thumb-item');
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);

        const timeRunning = 3000;
        const timeAutoNext = 14000;

        nextDom.onclick = function() {
            showSlider('next');    
        }

        prevDom.onclick = function() {
            showSlider('prev');    
        }

        let runTimeOut;
        let runNextAuto = setTimeout(() => {
            nextDom.click();
        }, timeAutoNext);

        function showSlider(type) {
            let SliderItemsDom = SliderDom.querySelectorAll('.carousel__item');
            let thumbnailItemsDom = document.querySelectorAll('.carousel__thumb-item');
            
            if (type === 'next') {
                SliderDom.appendChild(SliderItemsDom[0]);
                thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
                carouselDom.classList.add('carousel--next');
            } else {
                SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
                thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
                carouselDom.classList.add('carousel--prev');
            }

            clearTimeout(runTimeOut);
            runTimeOut = setTimeout(() => {
                carouselDom.classList.remove('carousel--next');
                carouselDom.classList.remove('carousel--prev');
            }, timeRunning);

            clearTimeout(runNextAuto);
            runNextAuto = setTimeout(() => {
                nextDom.click();
            }, timeAutoNext);
        }

        if (document.querySelector('.admin-pre-header')) {
            timeDom.style.top = '2rem';
        }
    }
    */

    /*=============== ESTIMATE FORM - DATE / TIME / SELECT / TEXTAREA ===============*/
    /*
    const form = document.getElementById('estimate-form');
    if (form) {
        const contactDate = document.getElementById('date');
        const selectElements = form.querySelectorAll('select');
        const contactTextarea = document.getElementById('comments');


        // Date setup
        if (contactDate) {
            const today = new Date().toISOString().split('T')[0];
            contactDate.setAttribute('min', today);

            contactDate.addEventListener("click", () => contactDate.showPicker());  // mehod that open calendar
            contactDate.addEventListener('change', function () {
                this.style.color = this.value === "" ? '#707070' : '#000';
            });
        }


        // Selects setup
        selectElements.forEach(select => {
            select.addEventListener('change', function () {
                this.style.color = this.value === "" ? '#707070' : '#000';
            });
        });


        // Textarea auto-resize
        contactTextarea?.addEventListener("input", (e) => {
            contactTextarea.style.height = "4rem";
            contactTextarea.style.height = `${e.target.scrollHeight}px`;
        });


        // Validation helpers
        const setError = (element, message) => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.estimate-form__error-message');
            if (errorDisplay) errorDisplay.innerText = message;
            inputControl.classList.add('estimate-form__error-message', 'error');
            inputControl.classList.remove('estimate-form__success');
        };

        const setSuccess = element => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.estimate-form__error-message');
            if (errorDisplay) errorDisplay.innerText = '';
            inputControl.classList.add('estimate-form__success');
            inputControl.classList.remove('estimate-form__error-message', 'error');
        };

        const isValidEmail = email => {
            return /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email.toLowerCase());
        };

        const validateForm = () => {
            let isValid = true;
            const fields = [
                { id: 'first-name', min: 2, msg: 'First Name is required', textMsg: 'Please enter correct First Name' },
                { id: 'last-name', min: 3, msg: 'Last Name is required', textMsg: 'Please enter correct Last Name' },
                { id: 'phone', min: 8, msg: 'Phone is required', textMsg: 'Please enter correct Phone' },
                { id: 'postal-code', min: 3, msg: 'Postal Code is required', textMsg: 'Please enter correct Postal Code' }
            ];

            fields.forEach(field => {
                const el = document.getElementById(field.id);
                if (!el) return;
                const val = el.value.trim();
                if (val === '') {
                    setError(el, field.msg);
                    isValid = false;
                } else if (val.length < field.min) {
                    setError(el, field.textMsg);
                    isValid = false;
                } else {
                    setSuccess(el);
                }
            });

            const emailEl = document.getElementById('email');
            if (emailEl) {
                const emailVal = emailEl.value.trim();
                if (emailVal === '') {
                    setError(emailEl, 'Email is required');
                    isValid = false;
                } else if (!isValidEmail(emailVal)) {
                    setError(emailEl, 'Provide a valid email address');
                    isValid = false;
                } else {
                    setSuccess(emailEl);
                }
            }

            return isValid;
        };

        // Form Submit via MODERN FETCH API
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            if (!validateForm()) return;

            showFormSuccessToast();
            temporarilyDisableSubmitButton();

            const formData = new FormData(form);

            try {
                // Переписано на Fetch API + async/await
                const response = await fetch('/send-email.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    const data = await response.text();
                    console.log('Success:', data);
                    form.reset();
                } else {
                    console.error('Server error:', response.status);
                }
            } catch (error) {
                console.error('Network error:', error);
            }
        });
    }

    // TOAST & BUTTON FUNCTIONS
    let formToastNotActive = true;
    function showFormSuccessToast() {
        if (!formToastNotActive) return;
        formToastNotActive = false;

        const toastHTML = `
            <div class="form-toast">
                <div class="form-toast__content">
                    <i class="ri-check-line form-toast__succes-icon"></i>
                    <div class="form-toast__message">
                        <h3>Message sent</h3>
                        <p>Message sent successfully!</p>
                    </div>
                </div>
                <i class="ri-close-line form-toast__close-icon"></i>
            </div>
        `;

        document.body.insertAdjacentHTML('afterbegin', toastHTML);
        const formToast = document.querySelector('.form-toast');

        // requestAnimationFrame гарантирует плавный старт анимации в микротасках
        requestAnimationFrame(() => formToast?.classList.add("active"));

        const removeToast = () => {
            if (!formToast) return;
            formToast.classList.remove("active");
            setTimeout(() => {
                formToastNotActive = true;
                formToast.remove();
            }, 600);
        };

        formToast?.querySelector('.form-toast__close-icon')?.addEventListener('click', removeToast);
        formToast?.addEventListener('animationend', removeToast);
    }

    function temporarilyDisableSubmitButton() {
        const submitBtn = document.getElementById('estimate-submit-button');
        if (!submitBtn) return;

        submitBtn.disabled = true;
        submitBtn.style.opacity = '.5';
        submitBtn.style.pointerEvents = 'none';

        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.pointerEvents = 'initial';
        }, 6000);
    }
    */


    new Preloader('page-preloader');

    new Header({
        headerSelector: '#header',
        toggleSelector: '#nav-toggle',
        navSelector: '#nav-menu',
        dropdownSelector: '.dropdown__item',
        subDropdownSelector: '.dropdown__subitem'
    });

    new Carousel('carousel');

    new BackgroundRandomizer('#hero-banner');

    new EstimateForm('estimate-form');
    
    // Дальше пойдут другие классы...
    // new CatalogFilters();
    // new OrderCalculator();







    /*=============== SCROLL REVEAL ANIMATION ===============*/
    const sr = ScrollReveal({
        origin: 'top',
        distance: '60px',
        duration: 2500,
        delay: 400,
        // reset: true 
    })


    sr.reveal(`.carousel__arrows`, { origin: 'left' })
    sr.reveal(`.carousel__thumbnails`, { origin: 'right' })

    sr.reveal(`.product__card`, { interval: 100 })
    sr.reveal(`.product__btn`, { origin: 'left' })

    sr.reveal(`.feature__content-1`, { origin: 'left' })
    sr.reveal(`.feature-item`, { interval: 100, distance: '32px' })

    sr.reveal(`.questions__title`, { distance: '40px' })
    sr.reveal(`.questions__group`, { interval: 100 })

    sr.reveal(`.feature__content-2`, { origin: 'right' })

    sr.reveal(`.contact__box`, { origin: 'left' })
    sr.reveal(`.estimate-form`, { origin: 'right' })

    sr.reveal(`.footer`)


    // --- 404 NOT FOUND PAGE ANIMATIONS ---
    sr.reveal(`.not-found__code`, { origin: 'top', delay: 200 })
    sr.reveal(`.not-found__title`, { origin: 'bottom', delay: 400 })
    sr.reveal(`.not-found__description`, { origin: 'bottom', delay: 600 })
    sr.reveal(`.not-found__btn`, { origin: 'bottom', delay: 800 })


    // --- PRODUCT PAGE ANIMATIONS ---
    // Секция: About Product
    sr.reveal(`.about-product__title`, { origin: 'top' })
    sr.reveal(`.about-product__description`, { origin: 'left', delay: 500 })
    sr.reveal(`.about-product__flex img`, { origin: 'right', delay: 600 })

    // Динамические подблоки (Заголовок + Текст) появляются снизу друг за другом
    sr.reveal(`.about-product__sub-title, .about-product__sub-description`, {
        origin: 'bottom',
        interval: 100,
        distance: '40px'
    })

    // Секция: Product Grid Images (Галерея)
    sr.reveal(`.product-grid-images__title`, { origin: 'top' })
    sr.reveal(`.product-grid-images__subtitle`, { origin: 'top', delay: 500 })

    // Картинки в галерее плавно раскрываются (scale) и появляются по очереди
    sr.reveal(`.product-grid-images__wrapper .image-container`, {
        interval: 150,  // задержка между появлением каждой картинки
        scale: 0.85,    // легкий эффект увеличения при появлении
        distance: '0px' // убираем сдвиг, оставляем только проявление и масштаб
    })

});
