$(document).ready(function () {

    function ajaxCallBack(url, func, data = {}) {
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: data,
            success: func,
            error: function (xhr) {
                console.error(xhr);
            }
        });
    }

    //Dodeljivanje Active klase Linkovima u navigaciji
    var page = document.querySelector('#stranica').dataset.page;
    var link = document.querySelectorAll('.ses');

    link.forEach(l => {
        if (l.dataset.curr == page) {
            l.parentElement.classList.add("active");
        }
    })
    // REGULARNI IZRAZI

    //RegEx funkcija
    function regEx(regEx, element, errMsg, help) {
        if (!regEx.test(element.value)) {
            document.querySelector(help).innerHTML = errMsg;
            $(help).removeClass('correct').addClass('false');
            return false;
        } else {
            document.querySelector(help).innerHTML = "Correct Input";
            $(help).removeClass('false').addClass('correct');
            return true;
        }
    }

    //Password potvrda
    function confirm(value, value2, errMsg, help) {
        if (value != value2) {
            document.querySelector(help).innerHTML = errMsg;
            $(help).removeClass('correct').addClass('false');
            return false;
        } else if (value2.length < 8) {
            document.querySelector(help).innerHTML = 'Incorect Input';
            $(help).removeClass('correct').addClass('false');
            return false;
        } else {
            document.querySelector(help).innerHTML = 'Password Confirmed';
            $(help).removeClass('false').addClass('correct');
            return true;
        }
    }

    //Log in & Sign up --email-- validacija
    var emailLogin = document.querySelector('#email');
    var regExEmail = /^([a-z0-9_ .-]+)@([\d a-z.-]+).([a-z.]{2,6})$/
    var errMsgEmail = "Email example : example@example.ex, can't contain any kind of white space, special characters and starts with letter";

    //Log in & Sign up --password-- validacija
    var passwordLogin = document.querySelector('#passwordReg');
    var regExPass = /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/;
    var errMsgPass = 'At least 8 characters long, max length anything\n' +
        'Include at least 1 lowercase letter\n' +
        '1 capital letter\n' +
        '1 number\n' +
        '1 special character => !@#$%^&*';

    ////Log in & Sign up --password-- potvrda
    var passwordComf = document.querySelector('#confirm_password');
    var errMsgPassComf = 'Please confirm your password';

    //Login Slanje
    try {
        let login = document.querySelector('#LogIn');
        login.addEventListener('click', function () {
            let niz = [
                regEx(regExEmail, emailLogin, errMsgEmail, '#emailHelp'),
                regEx(regExPass, passwordLogin, errMsgPass, '#passHelp'),
                confirm(passwordComf.value, passwordLogin.value, errMsgPassComf, '#passHelpComf')
            ];

            var greska = 0;
            niz.forEach(element => {
                if (element != true) {
                    greska++;
                }
            });

            if (greska == 0) {
                let sendData = {
                    emailLoginX: emailLogin.value,
                    passwordX: passwordLogin.value,
                    passwordComfX: passwordComf.value
                }
                ajaxCallBack('models/loging.php', function (result) {
                    if (result.msg == 'Successful Logging') {
                        window.location.href = "http://male-fashion.epizy.com//index.php?page=home";
                    } else {
                        $('#msg').removeClass('correct').addClass('false').html(result.msg);
                    }
                }, sendData);
            }
        })
    } catch (ex) {
    }

    //Registracija

    var firstnameReg = document.querySelector('#fname');
    var lastnameReg = document.querySelector('#lname');

    try {

        let register = document.querySelector('#register');
        register.addEventListener('click', function () {

            let niz = [
                regEx(regExFirstLastName, firstnameReg, errMsgFirstLastName, '#fnameHelp'),
                regEx(regExFirstLastName, lastnameReg, errMsgFirstLastName, '#lnameHelp'),
                regEx(regExEmail, emailLogin, errMsgEmail, '#emailHelp'),
                regEx(regExPass, passwordLogin, errMsgPass, '#passHelp'),
                confirm(passwordComf.value, passwordLogin.value, errMsgPassComf, '#passHelpComf')
            ];

            var greska = 0;
            niz.forEach(element => {
                if (element != true) {
                    greska++;
                }
            });

            if (greska == 0) {
                let sendData = {
                    fname: firstnameReg.value,
                    lname: lastnameReg.value,
                    emailRegX: emailLogin.value,
                    passwordX: passwordLogin.value,
                    passwordComfX: passwordComf.value
                }
                ajaxCallBack('models/registerUser.php', function (result) {
                    if (result.msg == 'Registration Failed') {
                        document.querySelector('.denied').style.display = 'block';
                        document.querySelector('.denied').style.marginTop = '20px';
                    } else {
                        localStorage.setItem('responseMsg', result.msg + " --- Redirecting to Log In page in 5s");
                        window.location.href = "http://male-fashion.epizy.com/index.php?page=response";
                    }
                }, sendData);
            }
        })
    }
    catch (ex) {

    }

    //Checkout --First Name & Last Name-- validacija
    var firstnameCheckout = document.querySelector('#firstName');
    var lastnameCheckout = document.querySelector('#lastName');
    var regExFirstLastName = /^([A-ZŠĐČĆŽ][a-zšđčćž]{2,14}\s?)+$/;
    var errMsgFirstLastName = "First and Last Name must start with capital letter and contain min 3 an max 15 letters"

    //Checkout --Email-- validacija
    var emailCheckout = document.querySelector('#email');

    //Checkout --Address-- validacija
    var adresa = document.querySelector('#address');
    var errMsgAdress = "Adress can start with Capital letter or number and can contain ., -, and digits ";
    var regExAdress = /^([A-Z]|[1-9]{1,4})[A-z\.\-\d\s]+$/;

    //Checkout --Zip-- validacija
    var zipCode = document.querySelector('#zip');
    var regExZip = /^[1-9]\d{4}$/;
    var errMsgZip = "Zip has 5 digits and can't start with 0";

    //Checkout --CCV-- validacija
    var ccv = document.querySelector("#cc-cvv");
    var ccvRegEx = /^[0-9]{3,4}$/
    var ccvHelpMsg = '3 or 4 digits are allowed';

    //Checkout --CardOwner-- validacija
    var inpcardOwner = document.querySelector('#cc-name');
    var regInpcardOwner = /^[A-ZČĆŽŠĐ]{3,14}\s[A-ZČĆŽŠĐ]{3,14}$/
    var cardNameHelpMsg = 'Contains only capital letters</br>Format: First Name and Last Name';

    //Checkout --CardNumber-- validacija
    var inpCardId = document.querySelector('#cc-number');
    var regInpCardId = /^[1-9][0-9]{3}\-[1-9][0-9]{3}\-[1-9][0-9]{3}\-[1-9][0-9]{3}$/
    var numHelp = 'Wrong format credit card number, cannot contain letters and must contain " - " between 4 numbers.';

    //Checkout Slanje
    try {
        let checkout = document.querySelector('#checkout');
        checkout.addEventListener('click', function () {
            let niz = [
                regEx(regExFirstLastName, firstnameCheckout, errMsgFirstLastName, '#firstNameHelp'),
                regEx(regExFirstLastName, lastnameCheckout, errMsgFirstLastName, '#lastNameHelp'),
                regEx(regExEmail, emailCheckout, errMsgEmail, '#emailHelp'),
                regEx(regExAdress, adresa, errMsgAdress, '#addressHelp'),
                regEx(regExZip, zipCode, errMsgZip, '#zipHelp'),
                regEx(ccvRegEx, ccv, ccvHelpMsg, '#cc-cvvHelp'),
                regEx(regInpcardOwner, inpcardOwner, cardNameHelpMsg, '#cc-nameHelp'),
                regEx(regInpCardId, inpCardId, numHelp, '#cc-numberHelp')
            ];

            var greska = 0;
            niz.forEach(element => {
                if (element != true) {
                    greska++;
                }
            });

            var selectedCountry = country.options[country.selectedIndex];
            if (selectedCountry.value == 'choose') {
                document.querySelector('#countryHelp').innerHTML = "Please Select Country";
                $('#countryHelp').removeClass('correct').addClass('false');
                greska++;
            }
            else {
                document.querySelector('#countryHelp').innerHTML = "Correct Input";
                $('#countryHelp').removeClass('false').addClass('correct');
            }

            var paymentX = '';

            var methods = document.getElementsByName('paymentMethod');
            methods.forEach(element => {
                if (element.checked) {
                    paymentX = element.id;
                }
            });
            if (greska == 0) {

                let sendData = {
                    firstName: firstnameCheckout.value,
                    lastName: lastnameCheckout.value,
                    email: emailCheckout.value,
                    address: adresa.value,
                    zip: zipCode.value,
                    ccv: ccv.value,
                    cardOwner: inpcardOwner.value,
                    cardNum: inpCardId.value,
                    country: selectedCountry.value,
                    payment: paymentX
                }
                ajaxCallBack('models/order.php', function (result) {
                    if (result.msg == 'Successful Ordering') {
                        localStorage.setItem('responseMsg', result.msg + " --- Redirecting to Home page in 5s");
                        window.location.href = "http://male-fashion.epizy.com/index.php?page=response";
                    }
                }, sendData);
            }
            else {

            }
        })
    }
    catch (ex) {

    }

    // REGULARNI IZRAZI --kraj--

    //Komentari i ocene proizvoda
    try {
        let sendReview = document.querySelector('#review');
        sendReview.addEventListener('click', function () {
            let ocena = $('#ocena :selected').val();
            let komentar = document.querySelector('#msg').value;
            let produkt = document.querySelector('#produkt').value;
            let user = document.querySelector('#korisnik').value;
            if (ocena != 0 && komentar.length != 0) {
                let sendData = {
                    ocenaX: ocena,
                    komentarX: komentar,
                    produktX: produkt,
                    userX: user
                }
                ajaxCallBack('models/writereview.php', function (result) {
                    if (result.msg == 'Review Sent') {
                        document.querySelector('#selectHelp').innerHTML = 'Review Sent';
                        $('#selectHelp').removeClass('false').addClass('correct');
                        location.reload();
                    }
                }, sendData);
            } else {
                document.querySelector('#selectHelp').innerHTML = 'Select Valid Grade and Write Review';
                $('#selectHelp').removeClass('correct').addClass('false');
            }
        })
    } catch (ex) {
    }

    //Dodavanje u korpu
    try {

        let add = document.querySelector('#add');
        add.addEventListener('click', function () {
            let sizes = document.getElementsByName('velicine');
            for (size of sizes) {
                if (size.checked) {
                    var sizeVal = size.value;
                }
            }
            if (sizeVal == undefined) {
                document.querySelector('#sizeHelp').innerHTML = 'Please Choose Size';
                $('#sizeHelp').removeClass('correct').addClass('false');
            }

            let color = document.querySelector('#colorSelected');
            if (color.value != '') {
                var colorVal = color.value;
            }
            else {
                document.querySelector('#boja').innerHTML = 'Please Choose Color';
                $('#boja').removeClass('correct').addClass('false');
            }

            let q = document.querySelector('#quan');
            var quantityVal = q.value;

            var produkt = document.querySelector('#produkt').value;
            var user = document.querySelector('#korisnik').value;

            if (colorVal != '' && sizeVal != undefined) {
                let sendData = {
                    size: sizeVal,
                    color: colorVal,
                    quantity: quantityVal,
                    product: produkt,
                    user: user
                }
                ajaxCallBack('models/addtocart.php', function (result) {
                    console.log(result);
                    if (result.msg == 'Added') {
                        document.querySelector('#added').innerHTML = 'Product Successfuly Added to Cart';
                        $('#added').removeClass('false').addClass('correct');

                    }
                    else {
                        document.querySelector('#added').innerHTML = 'Error occurred';
                        $('#added').removeClass('correct').addClass('false');
                    }
                }, sendData);
            }
        })
    } catch (ex) {
    }


    try {
        var remove = document.querySelectorAll('.remove');
        remove.forEach(element => {
            element.addEventListener('click', function () {
                ajaxCallBack('models/removeFromWishlist.php', function (result) {
                    location.reload();
                }, { id: element.dataset.id });
            })
        });
    }
    catch (ex) {

    }

    try {
        let page = 1;
        let productPerPage = 9;
        $('#search').on('input', function () {
            getProducts();
        })

        $('.category, .brand, .color, .price, .size, #ddlSortOrder').change(function () {
            getProducts();
        })

        getProducts();

        function getProducts() {
            var search = $('#search').val();

            let brands = [];
            for (let el of $('.brand:checked')) {
                brands.push(el.value);
            }

            let categories = [];
            for (let el of $('.category:checked')) {
                categories.push(el.value);
            }

            let price = $('.price:checked').val();

            let colors = [];
            for (let el of $('.color:checked')) {
                colors.push(el.value);
            }

            let sizes = [];
            for (let el of $('.size:checked')) {
                sizes.push(el.value);
            }

            let sortOrder = $('#ddlSortOrder').val();

            $.ajax({
                url: 'models/filteringSorting.php',
                dataType: 'json',
                method: 'GET',
                data: {
                    search: search,
                    brands: brands,
                    categories: categories,
                    prices: price,
                    colors: colors,
                    size: sizes,
                    sortOrder: sortOrder,
                    productsPerPage: productPerPage,
                    page: page
                },
                success: function (data) {
                    showProducts(data);
                },
                error: function (xhr) {
                    console.error(xhr)
                }
            });
        }

        function showProducts(data) {
            let prods = data.products;
            let html = '';
            if (prods.length != 0) {
                prods.forEach(e => {
                    html += `<div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-id='${e.idProdukt}' data-user='${id}' style='background-image: url("assets/img/product/${e.nazivSlike}");'>
                                        ${getNew(e)}
                                        <ul class="product__hover">
                                            <li>
                                                <a class="wishlist" id='y${e.idProdukt}'>${checkWishlist(e)}<span>Wishlist</span></a>
                                            </li>
                                            <li>
                                                <a href="index.php?page=details&prod=${e.idProdukt}"><img src="assets/img/icon/compare.png" alt=""> <span>Details</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                <div class="product__item__text">
                                    <h6>${e.imeProdukta}</h6>
                                    <a class="add-cart">${e.imeProdukta}</a>
                                    <div class="rating x${e.idProdukt}">
                                    ${getRating(e)}  
                                </div>
                                <h5>${e.nova} RSD</h5>
                                <div class="product__color__select r${e.idProdukt}">
                                ${getColors(e)};
                                </div>
                            </div>
                        </div>
                </div>`;
                });
            }
            else {
                html = 'No Products with Specified filter';
            }
            $('#produkti').html(html);

            //Pagination
            let numberOfPhones = data.num;
            let paginationHtml = '';
            if (numberOfPhones > 0) {
                for (let i = 0; i < numberOfPhones / productPerPage; i++) {
                    paginationHtml += `<a href='#' data-page='${i + 1}' class="btnPage">${i + 1}</a>`;
                }
            }

            $('#pagination').html(paginationHtml);
            try {
                enablePagination();
                wishlistClick();
            }
            catch (ex) {
            }
        }
        function enablePagination() {
            $('.btnPage').click(function (e) {
                e.preventDefault();
                page = $(this).data('page');
                getProducts();
            });
            for (let el of $('.btnPage')) {
                if ($(el).data('page') == page) {
                    $(el).addClass('active');
                    break;
                }
            }
        }
        function wishlistClick() {
            let niz = document.querySelectorAll('.product__item');
            niz.forEach(element => {
                var heart = element.querySelector('.wishlist');
                heart.addEventListener('click', function () {

                    var prod = element.querySelector('.product__item__pic').dataset.id;
                    var user = element.querySelector('.product__item__pic').dataset.user;
                    var senddata = {
                        prod: prod,
                        user: user
                    }
                    ajaxCallBack('models/addToWishlist.php', function (result) { }, senddata);


                    // Heart Apearence

                    $(this.children[0]).removeClass('far').addClass('fas');
                });
            });
        }
        function checkWishlist(prod) {

            ajaxCallBack('models/returnVariousInfo.php', function (data) {

                if (data.wishlist != 'empty') {

                    var arr = data.wishlist;

                    if (arr.length == 0) {
                        let loc = `#y${prod.idProdukt}`;
                        $(loc).html('<i class="far fa-heart"></i>');
                    }

                    arr.every(function (e) {
                        if (prod.idProdukt == e.idProdukt) {
                            let loc = `#y${prod.idProdukt}`;
                            $(loc).html('<i class="fas fa-heart"></i>');
                            return false;
                        }
                        else {
                            let loc = `#y${prod.idProdukt}`;
                            $(loc).html('<i class="far fa-heart"></i>');
                            return true;
                        }
                    })
                } else {
                    let loc = `#y${prod.idProdukt}`;
                    $(loc).html('<i class="far fa-heart"></i>');
                }
            }, { idProduktW: true });
        }
        //Various info
        function getNew(element) {
            if (element.novo == 1) {
                return '<span class="label">New</span>';
            }
            else {
                return '';
            }
        }
        function getRating(e) {
            ajaxCallBack('models/returnVariousInfo.php', function (data) {
                stars(data.result, data.avg, e.idProdukt);
            }, { idProduktR: e.idProdukt });

        }
        function getColors(e) {
            ajaxCallBack('models/returnVariousInfo.php', function (data) {
                colors(data.colors, e.idProdukt);
            }, { idProduktB: e.idProdukt });
        }
        function stars(res, avg, id) {
            let num = res.length;
            let html = '';

            if (res.length > 0 && avg > 0) {
                for (let i = 0; i < avg; i++) {
                    html += `<i class="fa fa-star"></i>&nbsp`;
                }
                for (let i = 0; i < 5 - avg; i++) {
                    html += `<i class="fa fa-star-o"></i>&nbsp`;
                }
                html += `<span>  ${num} Reviews</span>`;
            }
            else {
                for (let i = 0; i < 5; i++) {
                    html += `<i class="fa fa-star-o"></i>&nbsp`;
                }
                html += `<span>  0 Reviews</span>`;
            }
            let loc = `.x${id}`;
            $(loc).html(html);
        }
        function colors(colors, id) {
            let html = '';
            colors.forEach(element => {
                html += `<label for="pc-4" style="background-color: ${element.rgb}">
                <input type="radio" id="pc-4" disabled>
            </label>`
            })
            let loc = `.r${id}`;
            $(loc).html(html);
        }
        var id = document.querySelector('#idValue').dataset.id;
    }
    catch (ex) {

    }
 
    //Edit Product
    try {
        var edit = document.querySelector("#edit");
        edit.addEventListener('click', function () {
            //Prikupljanje podataka

        })
    }
    catch (ex) {

    }
    try {
        //Remove Message
        let deleteMsg = document.querySelectorAll('.deleteMsg');
        deleteMsg.forEach(element => {
            element.addEventListener('click', function () {
                console.log('tusam');
                ajaxCallBack('models/removeMessage.php', function (result) {
                    location.reload();
                }, { id: element.dataset.id });
            })
        });
    }
    catch (ex) {

    }

    try {
        let sendMsg = document.querySelector('#sendMsg');
        sendMsg.addEventListener('click', function () {

            let fullNameMsg = document.querySelector('#fullName');
            let emailMsg = document.querySelector("#email");
            let msg = document.querySelector('#msg').value;

            let niz = [
                regEx(regExFirstLastName, fullNameMsg, errMsgFirstLastName, '#fullNameHelp'),
                regEx(regExEmail, emailMsg, errMsgEmail, '#emailHelp'),
            ];

            var greska = 0;
            niz.forEach(element => {
                if (element != true) {
                    greska++;
                }
            });

            if (msg.length == 0) {
                greska++;
                document.querySelector('#msgHelp').innerHTML = "You can't send empty message";
                $('#msgHelp').removeClass('correct').addClass('false');
            }
            else {
                document.querySelector('#msgHelp').innerHTML = "Correct Input";
                $('#msgHelp').removeClass('false').addClass('correct');
            }
            if (greska == 0) {

                let sendData = {
                    fullName: fullNameMsg.value,
                    email: emailMsg.value,
                    msg: msg
                }

                ajaxCallBack('models/messages.php', function (result) {
                    if (result.msg == 'Message Sent') {
                        localStorage.setItem('responseMsg', result.msg + " --- Redirecting to Home page in 5s");
                        window.location.href = "http://male-fashion.epizy.com//index.php?page=response";
                    }
                }, sendData);
            }
        })
    }
    catch (ex) { }
    // GRESKA PRI SLANJU SLIKA I PODATAKA PREKO AJAXA
    // //Dodavanje produkta provera i slanje
    // try {
    //     let upload = document.querySelector('.uploadBtn');
    //     upload.addEventListener('click', function () {

    //         var form_data = new FormData();

    //         // Read selected files
    //         var totalfiles = document.querySelector('#files').files.length

    //         for (var index = 0; index < totalfiles; index++) {
    //             form_data.append("files[]", document.querySelector('#files').files[index]);
    //         }

    //         let cena = document.querySelector("#price").value;

    //         if (cena <= 0) {
    //             document.querySelector('#priceHelp').innerHTML = "Price can't be 0 or lower";
    //             $('#priceHelp').removeClass('correct').addClass('false');

    //         } else {
    //             document.querySelector('#priceHelp').innerHTML = "Correct Input";
    //             $('#priceHelp').removeClass('false').addClass('correct');
    //         }

    //         // Provera svih dropdown list
    //         function dropDownCheck(id, help) {

    //             var dropDown = document.querySelector(id);
    //             var dropDownVal = dropDown.options[dropDown.selectedIndex].value;

    //             if (dropDownVal == 'choose') {
    //                 document.querySelector(help).innerHTML = "Please choose valid value";
    //                 $(help).removeClass('correct').addClass('false');
    //                 return false;
    //             } else {
    //                 document.querySelector(help).innerHTML = "Correct Input";
    //                 $(help).removeClass('false').addClass('correct');
    //                 return dropDownVal;
    //             }
    //         }

    //         let dropResults = [dropDownCheck('#cat', '#catHelp'),
    //         dropDownCheck('#brand', '#brandHelp'),
    //         dropDownCheck('#tag', '#tagHelp'),
    //         dropDownCheck('#color', '#colorHelp'),
    //         dropDownCheck('#size', '#sizeHelp'),
    //         dropDownCheck('#coll', '#collHelp')];

    //         if (!dropResults.includes(false)) {

    //             let sendData = {
    //                 prodNamex: document.querySelector("#prodName").value,
    //                 desc: document.querySelector('#desc').value,
    //                 Price: cena,
    //                 Category: dropResults[0],
    //                 Brand: dropResults[1],
    //                 Tag: dropResults[2],
    //                 Color: dropResults[3],
    //                 Size: dropResults[4],
    //                 Collection: dropResults[5],
    //                 // Files: form_data
    //             }

    //             $.ajax({
    //                 url: 'models/addProduct.php',
    //                 type: 'POST',
    //                 dataType: 'json',
    //                 data: sendData,
    //                 // contentType: false,
    //                 // processData: false,
    //                 success: function (response) { },
    //                 error: function (xhr) {
    //                     console.error(xhr);
    //                 }
    //             });

    //         }
    //     })
    // } catch (ex) {
    // }
});


