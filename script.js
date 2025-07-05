window.onscroll = function() {
    const button = document.getElementById("back-to-top");
    if (document.documentElement.scrollTop > 300) {
        button.style.display = "block";
    } else {
        button.style.display = "none";
    }
};

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

window.onload = function () {
    const button = document.getElementById("back-to-top");
    button.style.display = "none";
};


document.addEventListener('DOMContentLoaded', () => {
    const scrollContainer = document.querySelector('.scroll-container');
    const leftButton = document.querySelector('.scroll-btn.left');
    const rightButton = document.querySelector('.scroll-btn.right');

    function scrollLeft() {
        scrollContainer.scrollBy({ left: -300, behavior: 'smooth' });
    }

    function scrollRight() {
        scrollContainer.scrollBy({ left: 300, behavior: 'smooth' });
    }

    if (leftButton){
        leftButton.addEventListener('click', scrollLeft);
    }

    if (rightButton){
        rightButton.addEventListener('click', scrollRight);
    }

    const toggleButtons = document.querySelectorAll(".toggle-article");
    if (toggleButtons.length === 0) {
        return;
    }

    toggleButtons.forEach(button => {
        const isLoggedIn = button.getAttribute('data-logged-in') === 'true';

            if (!isLoggedIn) {
                button.addEventListener("click", (e) => {
                    e.preventDefault();
                    alert('Pro čtení článků se prosím přihlaste.');
                });

                button.addEventListener("mouseenter", () => {
                    button.title = 'Pro čtení článků se musíte přihlásit.';
                });
            } else {
                button.addEventListener("click", () => {
                    const fullArticle = button.previousElementSibling;
                    if (fullArticle && fullArticle.classList.contains("full-article")) {
                        const isVisible = fullArticle.style.display === "block";
                        fullArticle.style.display = isVisible ? "none" : "block";
                        button.textContent = isVisible ? "Číst více" : "Skrýt";
                    } 
                });
            }
        
    });

    const articles = document.querySelectorAll(".blog-card");
    const prevButton = document.getElementById("prev-article");
    const nextButton = document.getElementById("next-article");
    let currentArticle = 0;

    function updateArticles() {
        articles.forEach((article, index) => {
            article.style.display = index === currentArticle ? "block" : "none";
        });
        if (prevButton) {
            prevButton.disabled = currentArticle === 0;
        }
        if (nextButton) {
            nextButton.disabled = currentArticle === articles.length - 1;
        }
    }
    if (prevButton) {
        prevButton.addEventListener("click", () => {
            if (currentArticle > 0) {
                currentArticle--;
                updateArticles();
            }
        });
    } 
    
    if (nextButton) {
        nextButton.addEventListener("click", () => {
            if (currentArticle < articles.length - 1) {
                currentArticle++;
                updateArticles();
            }
        });
    }
    updateArticles();
});

const loginSection = document.getElementById('login');
const registrationSection = document.getElementById('registration');
const switchToRegisterLink = document.getElementById('switch-to-register');
const switchToLoginLink = document.getElementById('switch-to-login');
const userProfileSection = document.getElementById("user-profile");

if (switchToRegisterLink && switchToLoginLink && loginSection && registrationSection){
    switchToRegisterLink.addEventListener('click', (e) => {
        e.preventDefault();

        loginSection.style.display = 'none';
        registrationSection.style.display = 'block';
        switchToRegisterLink.style.display = 'none';
    });

    switchToLoginLink.addEventListener('click', (e) => {
        e.preventDefault();

        registrationSection.style.display = 'none';
        loginSection.style.display = 'block';
        switchToRegisterLink.style.display = 'inline-block';
    });

}


const registrationForm = document.getElementById('registration-form');
const loginForm = document.getElementById('login-form');
if (registrationForm){
    registrationForm.addEventListener('submit', function(e){
        let isValid = true;

        const usernameInput = document.getElementById('username');
        const usernameValue = usernameInput.value.trim();
        const usernamePattern = /^[A-Za-z]+\s[A-Za-z]+$/;

        const phoneInput = document.getElementById('phone');
        const phoneValue = phoneInput.value.trim();
        const phonePattern = /^\+420\d{3}\d{3}\d{3}$/;

        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password-confirm');
        const passwordValue = passwordInput.value;
        const confirmPasswordValue = confirmPasswordInput.value;
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*.,])[A-Za-z\d!@#$%^&*.,]{8,20}$/;

        const fileInput = document.getElementById("profile-photo");
        const file = fileInput.files[0];

            if (!usernamePattern.test(usernameValue)) {
                alert('Jméno a přijmení musí obsahovat pouze latinské znaky a být oddělené mezerou.');
                usernameInput.focus();
                passwordInput.value = '';
                confirmPasswordInput.value = '';
                fileInput.value = "";
                isValid = false;
            }

            if (!phonePattern.test(phoneValue)) {
                alert('Nesprávný formát telefonního čísla. Použijte fórmat: +420123456789');
                phoneInput.focus();
                passwordInput.value = '';
                confirmPasswordInput.value = '';
                fileInput.value = "";
                isValid = false;
            }

            if (!passwordPattern.test(passwordValue)) {
                alert('Heslo musí obsahovat min. 8 znaků, včetně malých a velkých písmen, číslic a speciálních znaků.');
                passwordInput.value = '';
                confirmPasswordInput.value = '';
                passwordInput.focus();
                isValid = false;
            }

            if (passwordValue !== confirmPasswordValue) {
                e.preventDefault();
                alert('Hesla se neshodují. Zkuste to znovu.');
                passwordInput.value = '';
                confirmPasswordInput.value = '';
                passwordInput.focus();
                isValid = false;
            }

            if (!file) {
                alert("Nahrajte prosím profilový obrázek.");
                isValid = false;
            } else if (!file.type.startsWith("image/")){
                alert("Soubor musí být obrázek (JPEG, PNG nebo GIF).");
                fileInput.value = "";
                passwordInput.value = '';
                confirmPasswordInput.value = '';
                fileInput.focus();
                isValid = false;
            }

            if (!isValid){
                e.preventDefault();
            } else {
                registrationForm.submit();
            }

            const passwordHint = document.getElementById('password-hint');

            passwordInput.addEventListener('focus', () => {
                passwordHint.style.display = 'block';
            })

            passwordInput.addEventListener('input', () => {
                if (passwordPattern.test(passwordInput.value)){
                    passwordHint.textContent = 'Heslo splňuje všechny požadavky.';
                } else {
                    passwordHint.textContent = 'Heslo musí obsahovat minimálně 8 znaků, včetně malých a velkých písmen, číslic a speciálních znaků (!@#$%^&*,.).';
                }
            })

            passwordInput.addEventListener('blur', () =>  {
                passwordHint.style.display = 'none';
            });
    });
}

const editProfileBtn = document.getElementById('edit-profile-btn');
const editProfileSection = document.getElementById('edit-profile');
const editProfileForm = document.getElementById('edit-profile-form');
const cancelEditBtn = document.getElementById('cancel-edit');
const errorContainer = document.getElementById('error-container');
const errorMessages = document.getElementById('error-messages');


if (editProfileBtn && editProfileForm) {
    editProfileBtn.addEventListener('click', () => {
        userProfileSection.style.display = 'none';
        editProfileSection.style.display = 'block';
    });

    cancelEditBtn.addEventListener('click', () => {
        editProfileSection.style.display = 'none';
        userProfileSection.style.display = 'block';
    });

    editProfileForm.addEventListener('submit', (e) => {
        e.preventDefault();
        let isValid = true;
        let firstInvalidField = null;

        const newName = document.getElementById('new-name').value.trim();
        const newEmail = document.getElementById('new-email').value.trim();
        const newPassword = document.getElementById('new-password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        errorMessages.innerHTML = '';
        errorContainer.style.display = 'none';

        if(!newName){
            const li = document.createElement('li');
            li.textContent = "Jméno nemůže být prázdné.";
            errorMessages.appendChild(li);
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-password').value = '';
            if (!firstInvalidField) firstInvalidField = document.getElementById('new-name');
            isValid = false;
        }
        const usernamePattern = /^[A-Za-z]+\s[A-Za-z]+$/;
        if (!usernamePattern.test(newName)){
            const li = document.createElement('li');
            li.textContent = "Jméno a přijmení musí obsahovat pouze latinské znaky a být oddělené mezerou.";
            errorMessages.appendChild(li);
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-password').value = '';
            if (!firstInvalidField) firstInvalidField = document.getElementById('new-name');
            isValid = false;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(newEmail)){
            const li = document.createElement('li');
            li.textContent = "Neplatný email.";
            errorMessages.appendChild(li);
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-password').value = '';
            isValid = false;
        }

        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*.,])[A-Za-z\d!@#$%^&*.,]{8,20}$/;
        if (newPassword){
            if (!passwordPattern.test(newPassword)){
                const li = document.createElement('li');
                li.textContent = "Heslo musí obsahovat minimálně 8 znaků, včetně malých a velkých písmen, číslic a speciálních znaků (!@#$%^&*,.).";
                errorMessages.appendChild(li);
                document.getElementById('new-password').value = '';
                document.getElementById('confirm-password').value = '';
                if (!firstInvalidField) firstInvalidField = document.getElementById('new-password');
                isValid = false;
            }
            if (newPassword !== confirmPassword) {
                const li = document.createElement('li');
                li.textContent = "Hesla se neshodují.";
                errorMessages.appendChild(li);
                document.getElementById('new-password').value = '';
                document.getElementById('confirm-password').value = '';
                if (!firstInvalidField) firstInvalidField = document.getElementById('new-password');
                isValid = false;
            }
        }

        if (firstInvalidField) {
            firstInvalidField.focus();
        }

        if (!isValid){
            errorContainer.style.display = 'block';
            return
        }

        fetch('updateUser.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username: newName,
                email: newEmail,
                password: newPassword
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Údaje byly úspěšně aktualizovány!');
                    document.getElementById('user-name').textContent = newName;
                    document.getElementById('user-email').textContent = newEmail;
                    editProfileSection.style.display = 'none';
                    userProfileSection.style.display = 'block';
                } else if (data.errors) {
                    data.errors.forEach(error => {
                        const li = document.createElement('li');
                        li.textContent = error;
                        errorMessages.appendChild(li);
                    });
                    errorContainer.style.display  = 'block';
                } else {
                    alert('Došlo k neznámé chybě.');
                }
            })
            .catch(error => {
                console.error('Chyba:', error);
                alert('Došlo k chybě při komunikaci se serverem.');
            });
    });
}

const userTable = document.getElementById('admin-user-list');
const paginationContainer = document.getElementById('admin-pagination');

if (userTable && paginationContainer) {
    function decodeHtml(html) {
        const text = document.createElement("textarea");
        text.innerHTML = html;
        return text.value;
    }

    function fetchUsers(page = 1) {
        fetch(`ucet.php?action=fetch_users&page=${page}`)                
        .then(response => response.json())
            .then(data => {
                if (data.success) {
                    userTable.innerHTML = '';
                    data.users.forEach(user => {
                        const row = document.createElement('tr');
                        const idCell = document.createElement('td');
                        idCell.textContent = user.id;
                        row.appendChild(idCell);

                        const usernameCell = document.createElement('td');
                        usernameCell.textContent = decodeHtml(user.username);
                        row.appendChild(usernameCell);

                        const emailCell = document.createElement('td');
                        emailCell.textContent = user.email;
                        row.appendChild(emailCell);

                        const roleCell = document.createElement('td');
                        if (user.id != 1) {
                            const roleForm = document.createElement('form');
                            roleForm.method = 'post';
                            roleForm.className = 'role-form';

                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'user_id';
                            hiddenInput.value = user.id;

                            const roleSelect = document.createElement('select');
                            roleSelect.name = 'role';

                            const userOption = document.createElement('option');
                            userOption.value = 'user';
                            userOption.textContent = 'User';
                            if (user.role === 'user') userOption.selected = true;

                            const adminOption = document.createElement('option');
                            adminOption.value = 'admin';
                            adminOption.textContent = 'Admin';
                            if (user.role === 'admin') adminOption.selected = true;

                            roleSelect.appendChild(userOption);
                            roleSelect.appendChild(adminOption);

                            const saveButton = document.createElement('button');
                            saveButton.type = 'submit';
                            saveButton.name = 'update_role';
                            saveButton.textContent = 'Uložit';

                            roleForm.appendChild(hiddenInput);
                            roleForm.appendChild(roleSelect);
                            roleForm.appendChild(saveButton);

                            roleCell.appendChild(roleForm);
                        } else {
                            roleCell.textContent = 'N/A';
                        }
                        row.appendChild(roleCell);

                        const deleteCell = document.createElement('td');
                        if (user.id != 1) {
                            const deleteForm = document.createElement('form');
                            deleteForm.method = 'post';
                            deleteForm.className = 'delete-form';

                            const deleteHiddenInput = document.createElement('input');
                            deleteHiddenInput.type = 'hidden';
                            deleteHiddenInput.name = 'user_id';
                            deleteHiddenInput.value = user.id;

                            const deleteButton = document.createElement('button');
                            deleteButton.type = 'submit';
                            deleteButton.name = 'delete_user';
                            deleteButton.textContent = 'Odstranit';
                            deleteButton.onclick = () => confirm('Opravdu chcete odstranit tohoto uživatele?');

                            deleteForm.appendChild(deleteHiddenInput);
                            deleteForm.appendChild(deleteButton);

                            deleteCell.appendChild(deleteForm);
                        } else {
                            deleteCell.textContent = 'N/A';
                        }
                        row.appendChild(deleteCell);

                        userTable.appendChild(row);
                    });
    
                    paginationContainer.innerHTML = '';
                    for (let i = 1; i <= data.total_pages; i++) {
                        const btn = document.createElement('button');
                        btn.textContent = i;
                        btn.disabled = i === data.current_page;
                        btn.addEventListener('click', () => fetchUsers(i));
                        paginationContainer.appendChild(btn);
                    }
                }
            });
    } 
    fetchUsers();   
}

