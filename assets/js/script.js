const form = document.forms.registration

if (form) {

    const button = document.querySelector(".submit")
    button.addEventListener("click", () => {

            const firstName = form.fname.value
            const lastName = form.lname.value
            const email = form.email.value
            const password = form.password.value
            const repeatPassword = form.rpassword.value

            if (firstName && lastName && email && password && repeatPassword) {

                axios({
                    method: 'post',
                    url: '../../src/validate.php',
                    data: {
                        firstName: firstName,
                        lastName: lastName,
                        email: email,
                        password: password,
                        repeatPassword: repeatPassword
                    }
                })
                    .then(function (response) {
                        console.log('success', response)
                            let container = document.querySelector('.error-messages')
                            let form_el = document.querySelector('#form')
                            let s_message = document.querySelector('.success')
                            let err_title = container.querySelector('.error.error-title')
                            let err_user = container.querySelector('.error.error-user')
                            let err_email = container.querySelector('.error.error-email')
                            let err_pass = container.querySelector('.error.error-pass')

                            let errors = document.querySelectorAll('.error')
                            for(let error of errors){
                                error.classList.remove('show')
                            }

                            let codes = response['data']
                            if (codes.registered === true) {
                                form_el.classList.remove('show')
                                s_message.classList.add('show')
                            } else {
                                err_title.classList.add('show')
                                let errors = codes.errors
                                if (!errors.user) {
                                    err_user.classList.add('show')
                                }
                                if (!errors.pass) {
                                    err_pass.classList.add('show')
                                }
                                if (!errors.email) {
                                    err_email.classList.add('show')
                                }
                            }
                        }
                    )
                    .catch(function (error) {
                        console.log('error', error)
                    })
            }
        }
    )
}





