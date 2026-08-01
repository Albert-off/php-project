const toggleButton = document.getElementById('toggle-btn');
const adminSidebar = document.getElementById('admin-sidebar');

function toggleSidebar() {
    adminSidebar.classList.toggle('close');
    toggleButton.classList.toggle('rotate');

    closeAllSubMenues();
}

function toggleSubMenu(button) {

    // to close current dropdown
    if (!button.nextElementSibling.classList.contains('show')) {
        closeAllSubMenues();
    }

    button.nextElementSibling.classList.toggle('show');
    button.classList.toggle('rotate');

    if(adminSidebar.classList.contains('close')) {
        adminSidebar.classList.toggle('close');
        toggleButton.classList.toggle('rotate');
    }
}

function closeAllSubMenues() {
    Array.from(adminSidebar.getElementsByClassName('show')).forEach(ul => {
        ul.classList.remove('show');
        ul.previousElementSibling.classList.remove('rotate');  // .dropdwon-btn
    });
}




/* ----================ ADMIN SIDEBAR ACTIVE LINK ================---- */
document.addEventListener('DOMContentLoaded', () => {

    if (document.getElementById('sidebar_admin')) {
        document.querySelector('.admin_li').classList.add('link-active');
    }
    
    if (document.getElementById('sidebar_orders')) {
        document.querySelector('.orders_li').classList.add('link-active');
    }


    // --- Dropdown 1 | Users ---
    if (document.getElementById('sidebar_users_list')) {
        document.querySelector('.users_dropdown').classList.add('rotate');
        document.querySelector('.users_submenu').classList.add('show');
        document.querySelector('.users_list_li').classList.add('link-active');
    }

    if (document.getElementById('sidebar_users_create')) {
        document.querySelector('.users_dropdown').classList.add('rotate');
        document.querySelector('.users_submenu').classList.add('show');
        document.querySelector('.users_create_li').classList.add('link-active');
    }


    // --- Dropdown 2 | Posts ---
    if (document.getElementById('sidebar_posts_list')) {
        document.querySelector('.posts_dropdown').classList.add('rotate');
        document.querySelector('.posts_submenu').classList.add('show');
        document.querySelector('.posts_list_li').classList.add('link-active');
    }

    if (document.getElementById('sidebar_posts_create')) {
        document.querySelector('.posts_dropdown').classList.add('rotate');
        document.querySelector('.posts_submenu').classList.add('show');
        document.querySelector('.posts_create_li').classList.add('link-active');
    }


    // --- Dropdown 3 | Pages ---
    if (document.getElementById('sidebar_pages_home')) {
        document.querySelector('.pages_dropdown').classList.add('rotate');
        document.querySelector('.pages_submenu').classList.add('show');
        document.querySelector('.home_li').classList.add('link-active');
    }

    if (document.getElementById('sidebar_pages_fl_install')) {
        document.querySelector('.pages_dropdown').classList.add('rotate');
        document.querySelector('.pages_submenu').classList.add('show');
        document.querySelector('.fl_install_li').classList.add('link-active');
    }

    if (document.getElementById('sidebar_pages_aboutus')) {
        document.querySelector('.pages_dropdown').classList.add('rotate');
        document.querySelector('.pages_submenu').classList.add('show');
        document.querySelector('.aboutus_li').classList.add('link-active');
    }
});




/* ----======== TEXTAREA ========---- */
function autoResize(textarea) { 
    textarea.style.height = 'auto'; 
    textarea.style.height = (textarea.scrollHeight) + 'px'; 
}

function autoResizeAll() { 
    const textareas = document.querySelectorAll('textarea'); 
    textareas.forEach(textarea => autoResize(textarea));
}

window.addEventListener('load', autoResizeAll);



/* ----======== UPLOAD BUTTON ========---- */
function handleFileUpload(inputId, imgId, captionId) {
    let uploadButton = document.getElementById(inputId); 
    let choosenImage = document.getElementById(imgId);
    let fileName = document.getElementById(captionId); 
    
    uploadButton.onchange = () => { 
        let reader = new FileReader(); 
        reader.readAsDataURL(uploadButton.files[0]); 
        console.log(uploadButton.files[0]); 
        reader.onload = () => { 
            choosenImage.setAttribute('src', reader.result);
        }
        fileName.textContent = uploadButton.files[0].name;
    }
}

// Вызываем функцию для каждого блока загрузки 
if (document.getElementById('upload-button-1') && document.getElementById('upload-button-2')) {
    handleFileUpload('upload-button-1', 'choosen-img-1', 'file-name-1'); 
    handleFileUpload('upload-button-2', 'choosen-img-2', 'file-name-2');

} else if (document.getElementById('upload-button-1')) {
    handleFileUpload('upload-button-1', 'choosen-img-1', 'file-name-1'); 

} else if (document.getElementById('upload-button-2')) {
    handleFileUpload('upload-button-2', 'choosen-img-2', 'file-name-2');
}


// function submitLogout() {
//     document.getElementById('form-id').submit();
// }






/* ----================ SAVE AND FETCH SAVED DATA ================---- */

/* ----======== HOME PAGE ========---- */

function saveFeature(feature) {

    const featureTitleName        = feature ? 'feature_title1' : 'feature_title2';
    const featureDescriptonName   = feature ? 'feature_descripton1' : 'feature_descripton2';
    const featureImageName        = feature ? 'feature_img_url1' : 'feature_img_url2';
    const featureItem1Name        = feature ? 'feature_item_1' : 'feature_item2_1';
    const featureItem2Name        = feature ? 'feature_item_2' : 'feature_item2_2';
    const featureItem3Name        = feature ? 'feature_item_3' : 'feature_item2_3';
    const featureItem4Name        = feature ? 'feature_item_4' : 'feature_item2_4';

    const featureTitle        = feature ? 'feature-title-1' : 'feature-title-2';
    const featureDescripton   = feature ? 'feature-description-1' : 'feature-description-2';
    const featureImage        = feature ? 'upload-button-1' : 'upload-button-2';
    const featureItem1        = feature ? 'feature-item-1-1' : 'feature-item-2-1';
    const featureItem2        = feature ? 'feature-item-1-2' : 'feature-item-2-2';
    const featureItem3        = feature ? 'feature-item-1-3' : 'feature-item-2-3';
    const featureItem4        = feature ? 'feature-item-1-4' : 'feature-item-2-4';

    // Создайте FormData при каждом клике, чтобы данные были актуальными.
    const formData = new FormData();
    formData.append(featureTitleName, document.getElementById(featureTitle).value); 
    formData.append(featureDescriptonName, document.getElementById(featureDescripton).value); 
    formData.append(featureItem1Name, document.getElementById(featureItem1).value); 
    formData.append(featureItem2Name, document.getElementById(featureItem2).value); 
    formData.append(featureItem3Name, document.getElementById(featureItem3).value); 
    formData.append(featureItem4Name, document.getElementById(featureItem4).value);

    // Добавляем файл, если он выбран
    const fileInput = document.getElementById(featureImage);
    if (fileInput.files.length > 0) {
        formData.append(featureImageName, fileInput.files[0]);
    }

    const url = feature ? '/src/actions/pages/feature-1.php' : '/src/actions/pages/feature-2.php';

    const featueName = feature ? 'Feature 1' : 'Feature 2';

    if (confirmAction(featueName)) {
        fetchSavedData(formData, url);
    } else {
        console.log("User cancelled the action."); 
        console.log(`[${featueName}]`, "changes denied.");
    }
}


function saveQuestions() {
    // Создайте FormData при каждом клике, чтобы данные были актуальными.
    const formData = new FormData();
    formData.append('question_title', document.getElementById('questions-title').value);
    formData.append('question1_text', document.getElementById('question-1').value);
    formData.append('answer1_text', document.getElementById('answer-1').value);
    formData.append('question2_text', document.getElementById('question-2').value);
    formData.append('answer2_text', document.getElementById('answer-2').value);
    formData.append('question3_text', document.getElementById('question-3').value);
    formData.append('answer3_text', document.getElementById('answer-3').value);
    formData.append('question4_text', document.getElementById('question-4').value);
    formData.append('answer4_text', document.getElementById('answer-4').value);
    formData.append('question5_text', document.getElementById('question-5').value);
    formData.append('answer5_text', document.getElementById('answer-5').value);
    formData.append('question6_text', document.getElementById('question-6').value);
    formData.append('answer6_text', document.getElementById('answer-6').value);

    const url = '/src/actions/pages/questions.php';

    if (confirmAction('Questions')) {
        fetchSavedData(formData, url);
    } else {
        console.log("User cancelled the action."); 
        console.log("[Questions]", "changes denied.");
    }
}


/* ----======== SERVICES/FLOORING INSTALLATION PAGE ========---- */
function saveFlInstall() {
    // Создайте FormData при каждом клике, чтобы данные были актуальными.
    const formData = new FormData();
    formData.append('fl_install_title', document.getElementById('fl-install-title').value); 
    formData.append('fl_install_descr_1', document.getElementById('fl-install-descr-1').value); 
    formData.append('fl_install_subtitle', document.getElementById('fl-install-subtitle').value); 
    formData.append('fl_install_descr_2', document.getElementById('fl-install-descr-2').value);

    // Добавляем файл, если он выбран
    const fileInput = document.getElementById('upload-button-1');
    if (fileInput.files.length > 0) {
        formData.append('fl_install_img_url', fileInput.files[0]);
    }

    const url = '/src/actions/pages/flooring-installation.php';

    if (confirmAction('Flooring Installation')) {
        fetchSavedData(formData, url);
    } else {
        console.log("User cancelled the action."); 
        console.log("[Flooring Installation]", "changes denied.");
    }
}


/* ----======== ABOUT US PAGE ========---- */
function saveAboutUs() {
    // Создайте FormData при каждом клике, чтобы данные были актуальными.
    const formData = new FormData();
    formData.append('aboutus_title', document.getElementById('aboutus-title').value); 
    formData.append('aboutus_descr_1', document.getElementById('aboutus-descr-1').value); 
    formData.append('aboutus_subtitle', document.getElementById('aboutus-subtitle').value); 
    formData.append('aboutus_descr_2', document.getElementById('aboutus-descr-2').value);

    const url = '/src/actions/pages/aboutus.php';

    if (confirmAction('About Us')) {
        fetchSavedData(formData, url);
    } else {
        console.log("User cancelled the action."); 
        console.log("[About Us]", "changes denied.");
    }
}


function fetchSavedData(formData, url) {
    console.log('Отправка запроса на:', url, 'с данными:', formData);

    // Отправка запроса
    fetch(url, { 
        method: 'POST', 
        body: formData 
    })
    .then(response => response.text())  // Используем text() для получения сырого ответа
    .then(data => {
        try {
            let jsonData = JSON.parse(data);  // Пробуем распарсить как JSON
            console.log('Success:', jsonData);
            alert('Data saved successfully!');
        } catch (error) {
            console.error('Error parsing JSON:', error);
            console.log('Raw response:', data);  // Логируем нераспарсенный ответ
            alert('Error saving data.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving data.');
    });
}


function confirmAction(actionName) {

    const result = confirm(`Are you sure you want to save [${actionName}] changes?`);

    if (result) {
        console.log("User confirmed the data saving action.");
        console.log("Saving", actionName, "changes...");
    } 

    return result;
}



// document.getElementById('save-feature-content-1').addEventListener('click', function() { 
//     const formData = new FormData(); 
//     formData.append('feature_title', document.getElementById('feature-title-1').value); 
//     formData.append('feature_description', document.getElementById('feature-description-1').value); 
//     formData.append('feature_item1', document.getElementById('feature-item-1-1').value); 
//     formData.append('feature_item2', document.getElementById('feature-item-1-2').value); 
//     formData.append('feature_item3', document.getElementById('feature-item-1-3').value); 
//     formData.append('feature_item4', document.getElementById('feature-item-1-4').value); 

//     const imageFile = document.getElementById('upload-button-1').files[0]; 
//     if (imageFile) { 
//         formData.append('feature_image', imageFile); 
//     } 
    
//     fetch('your-server-endpoint.php', { 
//         method: 'POST', 
//         body: formData 
//     })
//     .then(response => response.json())
//     .then(data => { 
//         console.log('Success:', data); 
//         alert('Data saved successfully!'); 
//     })
//     .catch((error) => { 
//         console.error('Error:', error); 
//         alert('Error saving data.');
//     });
// });



/* ----================ DATA TABLE SEARCH ================---- */
if (document.getElementById('data-table')) {
    const search = document.querySelector('.input-group input');
    const table_rows = document.querySelectorAll('tbody tr');
    
    search.addEventListener('input', searchTable);
    
    function searchTable() {
        table_rows.forEach( (row, i) => {
            let table_data = row.textContent.toLowerCase();
            let search_data = search.value.toLowerCase();
    
            row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
            row.style.setProperty('--delay', i / 25 + 's');
    
            // 0/25 = 0s
            // 1/25 = 0.04s
            // 2/25 = 0.08s
            // 3/25 = 0.012s
        });
    
        // even rows black, odd rows white
        document.querySelectorAll('tbody tr:not(.hide)').forEach( (visible_row, i) => {
            visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#00000013';
        });
    }
}





/* ----================ SELECT ORDER STATUS ================---- */
if (document.getElementById('order-status')) {
    const selectOrderStatus = document.getElementById('order-status');
    const selectBox = document.querySelector('.order-status-select-box');

    const updateSelectBoxStyle = function (value) {
        let backgroundColor = ''; 
        let borderColor = '';
        let textColor = '#ffffff';

        switch (value) {
            case 'CANCELED':
                borderColor = '#F6A899';
                backgroundColor = '#F2451C';
                break;
            case 'NOT STARTED':
                borderColor = '#ACCEFD';
                backgroundColor = '#619FFC';
                break;
            case 'IN PROGRESS':
                borderColor = '#F8BD6D';
                backgroundColor = '#F49025';
                break;
            case 'COMPLETED':
                borderColor = '#98E1AD';
                backgroundColor = '#43BF57';
                break;
            default:
                borderColor = '#e6e6e6';
                backgroundColor = '#ffffff';
                textColor = '#11121a';
        }

        selectBox.style.backgroundColor = backgroundColor;
        selectBox.style.border = `2px solid ${borderColor}`;
        selectOrderStatus.style.color = textColor;
    };

    // Set the initial style when the page loads
    updateSelectBoxStyle(selectOrderStatus.value);

    selectOrderStatus.addEventListener('change', function () {
        updateSelectBoxStyle(this.value);
    });



    /*----============ SAVE ACTUAL STATUS ============----*/
    function saveOrderStatus() {
        const formData = new FormData();
        formData.append('order_status', document.getElementById('order-status').value);
        formData.append('order_id', document.getElementById('order-id').value);

        const url = '/src/actions/orders/order-status.php';

        const orderId = document.getElementById('order-id').value;

        if (confirmAction(`Order: ${orderId}`)) {
            fetchSavedData(formData, url);
        } else {
            console.log("User cancelled the action."); 
            console.log(`[Order: ${orderId}]`, "changes denied.");
        }
    }

}


// --- ARCHIVE ORDER ---
function archiveSelectedOrder(orderId) {
    console.log("Archiving order with ID:", orderId);
    const formData = new FormData();
    formData.append('order_id', orderId);

    const url = '/src/actions/orders/archive-order.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server Response:', data); // Логирование полного ответа от сервера
        if (data.success) {
            console.log(`Archiving successful for order ID: ${orderId}`);
            const orderRow = document.getElementById(`order-${orderId}`);
            // document.querySelector(`#order-${orderId} .arc-btn`).disabled = true;
            if (orderRow) {
                orderRow.remove();
                alert('Order archived successfully!');
            } else {
                console.warn(`Order row with ID ${orderId} not found.`);
                alert('Order archived successfully, but could not find the row to remove.');
            }
        } else {
            console.error('Archiving failed:', data.message || data.error);
            alert('Failed to archive order: ' + (data.message || data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error archiving order.');
    });
}


// --- UNARCHIVE ORDER ---
function unarchiveSelectedOrder(orderId) {
    console.log("Unarchiving order with ID:", orderId);
    const formData = new FormData();
    formData.append('order_id', orderId);

    const url = '/src/actions/orders/unarchive-order.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Используем text() для получения сырого ответа
    .then(data => {
        console.log('Server Response:', data); // Логирование полного ответа от сервера
        if (data.success) {
            console.log(`Unarchiving successful for order ID: ${orderId}`);
            const orderRow = document.getElementById(`order-${orderId}`);
            if (orderRow) {
                orderRow.remove();
                alert('Order unarchived successfully!');
            } else {
                console.warn(`Order row with ID ${orderId} not found.`);
                alert('Order unarchived successfully, but could not find the row to remove.');
            }
        } else {
            console.error('Unarchiving failed:', data.message || data.error);
            alert('Failed to unarchive order: ' + (data.message || data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error unarchiving order.');
    })
}


// --- SOFT DELETE ORDER ---
function softDeleteSelectedOrder(orderId) {
    console.log("Soft Deleting order with ID:", orderId);
    const formData = new FormData();
    formData.append('order_id', orderId);

    const url = '/src/actions/orders/soft-delete-order.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Используем text() для получения сырого ответа
    .then(data => {
        console.log('Server Response:', data); // Логирование полного ответа от сервера
        if (data.success) {
            console.log(`Soft Deleting successful for order ID: ${orderId}`);
            const orderRow = document.getElementById(`order-${orderId}`);
            if (orderRow) {
                orderRow.remove();
                alert('Order soft deleted successfully!');
            } else {
                console.warn(`Order row with ID ${orderId} not found.`);
                alert('Order soft deleted successfully, but could not find the row to remove.');
            }
        } else {
            console.error('Soft Deleting failed:', data.message || data.error);
            alert('Failed to soft delete order: ' + (data.message || data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error soft deleting order.');
    })
}


// --- RESTORE ORDER ---
function restoreSelectedOrder(orderId) {
    console.log("Restoring order with ID:", orderId);
    const formData = new FormData();
    formData.append('order_id', orderId);

    const url = '/src/actions/orders/restore-order.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Используем text() для получения сырого ответа
    .then(data => {
        console.log('Server Response:', data); // Логирование полного ответа от сервера
        if (data.success) {
            console.log(`Restoring successful for order ID: ${orderId}`);
            const orderRow = document.getElementById(`order-${orderId}`);
            if (orderRow) {
                orderRow.remove();
                alert('Order restored successfully!');
            } else {
                console.warn(`Order row with ID ${orderId} not found.`);
                alert('Order restored successfully, but could not find the row to remove.');
            }
        } else {
            console.error('restoring failed:', data.message || data.error);
            alert('Failed to restore order: ' + (data.message || data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error restoring order.');
    })
}


// --- PERMANENTLY DELETE ORDER ---
function permanentlyDeleteSelectedOrder(orderId, orderIndex) {

    const result = confirm(`Are you sure you want to Permanently Delete [Order: ${orderIndex}] ?`);

    if (result) {
        console.log("Permanently deleting order with ID:", orderId);
        const formData = new FormData();
        formData.append('order_id', orderId);
    
        const url = '/src/actions/orders/permanently-delete-order.php';
    
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())  // Используем text() для получения сырого ответа
        .then(data => {
            console.log('Server Response:', data); // Логирование полного ответа от сервера
            if (data.success) {
                console.log(`Permanently deleting successful for order ID: ${orderId}`);
                const orderRow = document.getElementById(`order-${orderId}`);
                if (orderRow) {
                    orderRow.remove();
                    alert('Order permanently deleted successfully!');
                } else {
                    console.warn(`Order row with ID ${orderId} not found.`);
                    alert('Order permanently deleted successfully, but could not find the row to remove.');
                }
            } else {
                console.error('restoring failed:', data.message || data.error);
                alert('Failed to permanently delete order: ' + (data.message || data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error permanently deleting order.');
        })
    }
}


// --- EXPIRED ORDERS AUTO DELETION RESPONSE ---
if (document.getElementById('autoDeleteResponse')) {
    
    const autoDeleteResponseElement = document.getElementById('autoDeleteResponse');
    
    if (autoDeleteResponseElement) {
        const output = JSON.parse(autoDeleteResponseElement.value);

        if (output.success) {
            // console.log(output.message);
            const entries = Object.entries(output).map(([key, value]) => `${key}: ${value}`);
            console.log(`{ ${entries.join(', ')} }`);

        } else {
            console.error(output.error || output.message);
        }
    }    
}




/* ----======== UPLOAD POSTS IMAGES ========---- */
if (document.getElementById('sidebar_posts_create')) {
    let fileInput = document.getElementById('post-images');
    let numOfFiles = document.getElementById('num-of-uploaded-post-files');
    let imageContainer = document.getElementById('uploaded-post-images');

    // Maximum number of image uploads.
    const maxFiles = 4;

    function uploadedImagesPreview() {

        if (fileInput.files.length > maxFiles) {
            alert(`You can only upload up to ${maxFiles} files.`);
            fileInput.value = "";  // Clear selected files.
            return;
        }

        imageContainer.innerHTML = "";  // deleting old data
        numOfFiles.textContent = `${fileInput.files.length} Files Selected`;

        for (const i of fileInput.files) {
            let reader = new FileReader();
            let figure = document.createElement("figure");
            let figCap = document.createElement("figcaption");

            figCap.innerText = i.name;
            figure.appendChild(figCap);
            reader.onload = () => {
                let img = document.createElement("img");
                img.setAttribute("src", reader.result);
                figure.insertBefore(img, figCap);
            }
            imageContainer.appendChild(figure);
            reader.readAsDataURL(i);
        }
        imageContainer.style.marginBottom = '1rem';
    }
}



/* ----================ SELECT POST STATUS ================---- */
if (document.getElementById('post-status')) {
    const selectPostStatus = document.getElementById('post-status');
    const selectBox = document.querySelector('.post-status-select-box');

    const updateSelectBoxStyle = function (value) {
        let borderColor = '';
        let backgroundColor = ''; 
        let textColor = '#ffffff';

        switch (value) {
            case 'UNPUBLISHED':
                borderColor = '#F8BD6D';
                backgroundColor = '#F49025';
                break;
            case 'PUBLISHED':
                borderColor = '#98E1AD';
                backgroundColor = '#43BF57';
                break;
            default:
                borderColor = '#e6e6e6';
                backgroundColor = '#ffffff';
                textColor = '#11121a';
        }

        selectBox.style.backgroundColor = backgroundColor;
        selectBox.style.border = `2px solid ${borderColor}`;
        selectPostStatus.style.color = textColor;
    };

    // Set the initial style when the page loads
    updateSelectBoxStyle(selectPostStatus.value);

    selectPostStatus.addEventListener('change', function () {
        updateSelectBoxStyle(this.value);
    });



    /*----============ SAVE ACTUAL STATUS ============----*/
    function savePostStatus() {
        const formData = new FormData();
        formData.append('post_status', document.getElementById('post-status').value);
        formData.append('post_id', document.getElementById('post-id').value);

        const url = '/src/actions/posts/change-post-status.php';

        const postId = document.getElementById('post-id').value;

        if (confirmAction(`Post: ${postId}`)) {
            fetchSavedData(formData, url);
        } else {
            console.log("User cancelled the action."); 
            console.log(`[Post: ${postId}]`, "changes denied.");
        }
    }

}



/* ----================ POST IMAGES SLIDER ================---- */
if (document.getElementById('post-slider')) {

    let slideIndex = 1;
    showSlides(slideIndex);
    
    function moveSlides(n) {
        showSlides(slideIndex += n)
    }
    
    function currentSlide(n) {
        showSlides(slideIndex = n)
    }
    
    function showSlides(n) {
        const slides = document.getElementsByClassName('post-slide');
        const dots = document.getElementsByClassName('dot');

        if (n > slides.length) { 
            slideIndex = 1 
        }

        if (n < 1) { 
            slideIndex = slides.length; 
        }

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" dot-active", "")
        }
        
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " dot-active";
    }


    // Auto Slide

    // slideIndex = 0;
    // showSlides();

    // function showSlides() {
    //     const slides = document.getElementsByClassName('post-slide');

    //     for (let i = 0; i < slides.length; i++) {
    //         slides[i].style.display = "none";
    //     }

    //     slideIndex++;

    //     if (slideIndex > slides.length) {
    //         slideIndex = 1;
    //     }
    //     slides[slideIndex - 1].style.display = "block";
    //     setTimeout(showSlides, 2000);
    // }
}