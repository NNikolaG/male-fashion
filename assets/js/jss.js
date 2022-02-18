//https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/ceil
// Closure
(function () {
    /**
     * Decimal adjustment of a number.
     *
     * @param {String}  type  The type of adjustment.
     * @param {Number}  value The number.
     * @param {Integer} exp   The exponent (the 10 logarithm of the adjustment base).
     * @returns {Number} The adjusted value.
     */
    function decimalAdjust(type, value, exp) {
      // If the exp is undefined or zero...
      if (typeof exp === 'undefined' || +exp === 0) {
        return Math[type](value);
      }
      value = +value;
      exp = +exp;
      // If the value is not a number or the exp is not an integer...
      if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
        return NaN;
      }
      // Shift
      value = value.toString().split('e');
      value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
      // Shift back
      value = value.toString().split('e');
      return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
    }
    // Decimal ceil
    if (!Math.ceil10) {
      Math.ceil10 = function (value, exp) {
        return decimalAdjust('ceil', value, exp);
      };
    }
  })();
  
  //////////////////  NAVIGACIJA  /////////////////////////
  
  //onScroll navigacioni menu
  window.onscroll = function () { myFunction() };
  
  function myFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      document.getElementById("navbar-row").style.backgroundColor = "rgba(0,0,0,0.5)";
      document.getElementById("navbar-row").style.transition = "0.6s ease-in-out";
    }
    else if (document.body.scrollTop < 50 || document.documentElement.scrollTop < 50) {
      document.getElementById("navbar-row").style.backgroundColor = "rgba(0, 0, 0, 0)";
    }
  }
  //End
  
  //Dohvatanje vrijednosti taga title kako bi za odgovarajucu stranicu dodao ACTIVE klasu za odgovarajuci nav-link
  var title = document.querySelector('#title');
  //Elementi
  let navElemnts = new Array('Home', 'Shop', 'Author');
  //Linkovi
  let navLinks = new Array('index.html', 'cart.html', 'author.html');
  //Shopping Cart
  let numberOfProductsinCart = `<li class="nav-item active shopCart">
  <a class="nav-link float-lg-right" href="cart.html"><i class='fas fa-shopping-bag'></i> <span class='numberOfProductsinCart'>0</span></a>
  </li>`
  //Ispis
  var ispis3 = '';
  for (let i = 0; i < navElemnts.length; i++) {
    if (title.textContent == navElemnts[i]) {
      ispis3 += `
      <li class="nav-item active">
      <a class="nav-link" href="${navLinks[i]}">${navElemnts[i]}</a>
      </li>
   `
      continue;
    }
    ispis3 += `
       <li class="nav-item">
       <a class="nav-link" href="${navLinks[i]}">${navElemnts[i]}</a>
       </li>
    `
  }
  document.querySelector(".navbar-nav").innerHTML = ispis3 + numberOfProductsinCart;
  //End
  
  
  
  ////////////////// HOME PAGE /////////////////////////
  $('#carouselExampleFade').carousel({
    interval: 4000,
    ride: true
  })
  try {
  
    //Media query for Video Div
    function mediaQuery(maxWidth) {
      if (maxWidth.matches) {
        let videoSRC = document.querySelector('#videoSRC');
        videoSRC.attributes.src.value = 'img/2.mp4'
      } else {
        videoSRC.attributes.src.value = 'img/1.mp4'
      }
  
    }
  
    var maxWidth = window.matchMedia("(max-width: 768px)");
    mediaQuery(maxWidth);
    maxWidth.addListener(mediaQuery);
  
    //Timer
    let countDate = new Date('Dec 30, 2020 00:00:00').getTime();
    function newYear() {
      let now = new Date().getTime();
  
      gap = countDate - now;
  
      let sec = 1000;
      let minute = sec * 60;
      let hours = minute * 60;
      let day = hours * 24;
  
      let d = Math.floor(gap / (day));
      let h = Math.floor((gap % (day)) / (hours));
      let m = Math.floor((gap % (hours)) / (minute));
      let s = Math.floor((gap % (minute)) / (sec));
  
      document.querySelector('#d').innerText = d;
      document.querySelector('#h').innerText = h;
      document.querySelector('#m').innerText = m;
      document.querySelector('#s').innerText = s;
    }
    setInterval(() => {
      newYear();
    }, 1000);
  }
  catch (e) { }
  //Mini Galerija Ispis
  
  //Imena produkata u nizu
  var productNames = new Array('EMBROIDERED BLOUSE', 'RUCHED SATIN EFFECT SHIRT', 'ELASTIC WAIST MIDI DRESS', 'V-NECK BLOUSE', 'LONG COAT', 'HIGH-WAISTED PANTS', 'BELTED CROPPED BLAZER', 'SHOULDER PAD POPLIN BODYSUIT', 'FAUX FUR WRAP COAT');
  
  var galItem = '';
  
  //Niz Cijena
  var price = new Array("49.90€", "39.90€", "69.90€", "39.90€", "119€", "39.90€", "89.90€", "39.90€", "119.90€");
  
  //Niz putanja do fotografija produkata
  var nizGalMini = new Array('img/product1.jpg', 'img/product2.jpg', 'img/product3.jpg', 'img/product4.jpg', 'img/product5.jpg', 'img/product6.jpg', 'img/product7.jpg', 'img/product8.jpg', 'img/product9.jpg');
  
  //Niz alt-tag
  var nizGalMiniAlt = new Array('product1', 'product2', 'product3', 'product4', 'product5', 'product6', 'product7', 'product8', 'product9');
  
  //Petlja-ispis
  try {
    for (let i = 0; i < nizGalMini.length; i++) {
      galItem += `
      <div class="proizvod">
      <div class='sad-proz'>
          <img src="${nizGalMini[i]}" alt="${nizGalMiniAlt[i]}">
          <!-- Hover Content -->
          <div class="hover">
              <p>From ${price[i]}</p>
              <div class='sadrzaj-hovera'>
              <h4>${productNames[i]}</h4>
              <button type="button" class="btn cart">Add to Cart</button>
              </div>
          </div>
      </div>
    </div>
      
      `
      //Smestanje produkata u kolone
      switch (i) {
        case 2:
          document.querySelector('#kolona1').innerHTML = galItem;
          galItem = '';
          break;
        case 5:
          document.querySelector('#kolona2').innerHTML = galItem;
          galItem = '';
          break;
        case 8:
          document.querySelector('#kolona3').innerHTML = galItem;
          galItem = '';
          break;
      }
    }
    //End  
  }
  catch (e) {
    console.log("Ovaj dio koda se izvrsava na index.html stranici");
  }
  // KOD PREUZET SA https://www.youtube.com/watch?v=B20Getj_Zk4
  //addToCart
  let carts = document.querySelectorAll(".cart");
  
  //Prepisivanje vrijednosti iz nizova (koju su sluzili za ispis informacija za produkte u galeriji) u novi niz objekata
  let products = new Array();
  for (let i = 0; i < price.length; i++) {
    products[i] = {
      name: productNames[i],
      price: price[i],
      inCart: 0,
      tag: nizGalMiniAlt[i]
    }
  }
  
  //Dohvatanje produkta 
  for (let i = 0; i < carts.length; i++) {
    carts[i].addEventListener('click', () => {
      cartNumber(products[i]);
      totalProductCost(products[i]);
    })
  }
  //broj Produkata nakon Reload-ovanja stranice
  function onLoadCartNumber() {
  
    let productNumbers = localStorage.getItem('cartNumber');
  
    if (productNumbers) {
  
      document.querySelector(".numberOfProductsinCart").textContent = productNumbers;
    }
  }
  //broj Produkata u korpi
  function cartNumber(product) {
  
    let productNumbers = localStorage.getItem('cartNumber');
  
    productNumbers = parseInt(productNumbers);
  
    if (productNumbers) {
  
      localStorage.setItem("cartNumber", productNumbers + 1);
      document.querySelector(".numberOfProductsinCart").textContent = productNumbers + 1;
  
    }
    else {
      localStorage.setItem("cartNumber", 1);
  
      document.querySelector(".numberOfProductsinCart").textContent = 1;
    }
    setItems(product);
  
  }
  //vrsta Produkta u korpi
  function setItems(product) {
    let cartItems = localStorage.getItem('productsInCart');
    cartItems = JSON.parse(cartItems);
    if (cartItems != null) {
      if (cartItems[product.tag] == undefined) {
        cartItems = {
          ...cartItems,
          [product.tag]: product
  
        }
      }
      cartItems[product.tag].inCart += 1;
    }
    else {
      product.inCart = 1;
      cartItems = {
        [product.tag]: product
      }
    }
    localStorage.setItem('productsInCart', JSON.stringify(cartItems));
  }
  //Ukupna cijena svih produkata dodatih u korpu
  function totalProductCost(product) {
    let cost = localStorage.getItem('totalCost');
    product.price = parseFloat(product.price, 2);
  
    if (cost != null) {
      cost = parseFloat(cost, 2);
      localStorage.setItem('totalCost', Math.ceil10(cost + product.price, -1));
    }
    else {
      localStorage.setItem('totalCost', product.price);
    }
  }
  
  ////////////////// CART PAGE /////////////////////////
  
  //Prikazivanje inf. o produktima na cart.html stranici
  function dispalyCart() {
    let cartItems = localStorage.getItem("productsInCart");
    let cost = localStorage.getItem('totalCost');
    cartItems = JSON.parse(cartItems);
    var table = document.querySelector("#cart-table");
    //Dinamicki ispis svih elemenata korpe
    if (cartItems && table) {
      let i = 0;
      table.innerHTML = `
      <div class="row tabel-header">
      <div class='num col-sm-12 col-md-1'>#</div>
      <div class="cart-img col-sm-12 col-md-2">Picture</div>
      <div class="name col-md-5">Name</div>
      <div class="quantity col-md-2">Quantity</div>
      <div class="price col-md-2">Price Sum</div>
      </div>`;
      Object.values(cartItems).map(item => {
        i++;
        table.innerHTML += `
         <div class="row">
         <div class='num col-md-1'><span>${i}</span></div>
         <div class="cart-img col-md-2"><img src='img/${item.tag}.jpg'></div>
         <div class="name col-md-5">${item.name}</div>
         <div class="quantity col-md-2">
         <i class="fa fa-chevron-circle-left lower-product" aria-hidden="true"></i>&nbsp;&nbsp;
         <span class='quantitySpan'>${item.inCart}</span>
         &nbsp;&nbsp;<i class="fa fa-chevron-circle-right  add-product" aria-hidden="true"></i>
         </div>
         <div class="price col-md-2">
         <span class='priceSpan'>${Math.ceil10(parseFloat(item.price) * item.inCart, -1)}</span> €</div>
       </div>
         `
      })
      table.innerHTML += `
      <div class="row tabel-footer">
      <div class='num  col-md-10'><span id='remove'><i class="fa fa-times-circle" aria-hidden="true"></i><span>Remove all products from cart</span></span></div>
      <div class="total-price col-md-2">Total Price</div>
      </div>
      <div class="row">
      <div class='num col-md-10'></div>
      <div class="total-price col-md-2"><span class='totalPriceSpan'>${cost}</span> €</div>
      </div>`;
    }
  
    //Praznjenje korpe
    try {
      let removeProductFromCart = document.querySelector('#remove');
      removeProductFromCart.addEventListener('click', function () {
        let x = document.querySelector('#cart-table');
        localStorage.clear();
        location.reload(x);
      })
    }
    catch (e) {
      try {
        let x = document.querySelector('#empty');
  
        x.innerHTML = '<h2>CART IS EMPTY</h2>';
      }
      catch (e) {}
    }
  
    //Dodavanje produkta klikom na '>' ikonicu
    let addProduct = document.querySelectorAll(".add-product");
  
    for (let i = 0; i < addProduct.length; i++) {
      addProduct[i].addEventListener('click', () => {
  
        let arrayOfObjectValues = Object.values(cartItems);
        stackProduct(arrayOfObjectValues[i], i);
  
      })
    }
    function stackProduct(product, i) {
  
      let productNumbers = localStorage.getItem('cartNumber');
      productNumbers = parseInt(productNumbers);
  
      if (productNumbers) {
        localStorage.setItem("cartNumber", productNumbers + 1);
        document.querySelector(".numberOfProductsinCart").textContent = productNumbers + 1;
      }
      else {
        localStorage.setItem("cartNumber", 1);
        document.querySelector(".numberOfProductsinCart").textContent = 1;
      }
  
      if (cartItems != null) {
        cartItems[product.tag].inCart += 1;
      }
      else {
        product.inCart = 1;
        cartItems = {
          [product.tag]: product
        }
      }
  
      let quantityNumber = document.querySelectorAll('.quantitySpan');
      quantityNumber[i].innerHTML = cartItems[product.tag].inCart;
  
      let priceProductSum = document.querySelectorAll('.priceSpan');
      priceProductSum[i].innerHTML = Math.ceil10(parseFloat(product.price) * cartItems[product.tag].inCart, -1);
  
      totalProductCost(product);
  
      cost = localStorage.getItem('totalCost');
      let totalSum = document.querySelector('.totalPriceSpan');
      cost = parseFloat(cost);
      totalSum.innerHTML = cost;
  
      localStorage.setItem('productsInCart', JSON.stringify(cartItems));
    }
  
    //Oduzimanje produkta iz korpe klikom na '<' ikonicu
    let lowProduct = document.querySelectorAll(".lower-product");
  
    for (let i = 0; i < lowProduct.length; i++) {
      lowProduct[i].addEventListener('click', () => {
  
        let arrayOfObjectValues = Object.values(cartItems);
        lowerProduct(arrayOfObjectValues[i], i);
  
      })
    }
  
    function lowerProduct(product, i) {
  
      let productNumbers = localStorage.getItem('cartNumber');
      productNumbers = parseInt(productNumbers);
  
      let cost = localStorage.getItem('totalCost');
      product.price = parseFloat(product.price, 2);
      cost = parseFloat(cost, 2);
  
      if (product.inCart > 0) {
        product.inCart -= 1;
        localStorage.setItem('totalCost', Math.ceil10(cost - product.price, -1));
        localStorage.setItem("cartNumber", productNumbers - 1);
        document.querySelector(".numberOfProductsinCart").textContent = productNumbers - 1;
      }
  
      else if (product.inCart == 0) {
        localStorage.setItem("cartNumber", productNumbers);
        document.querySelector(".numberOfProductsinCart").textContent = productNumbers;
      }
  
      let quantityNumber = document.querySelectorAll('.quantitySpan');
      quantityNumber[i].innerHTML = product.inCart;
  
      let priceProductSum = document.querySelectorAll('.priceSpan');
      priceProductSum[i].innerHTML = Math.ceil10(product.price * product.inCart, -1);
  
      cost = localStorage.getItem('totalCost');
      let totalSum = document.querySelector('.totalPriceSpan');
      cost = parseFloat(cost);
      totalSum.innerHTML = cost;
  
      localStorage.setItem('productsInCart', JSON.stringify(cartItems));
    }
  }
  
  dispalyCart();
  onLoadCartNumber();
  //End
  
  let outputCity = document.querySelector('#outCity');
  
  try {
    //Promenljiva se uvecava za 1 pri svakom validnom unosu korisnika, na osvovu njene vrijednosti prilikom klika na taster 'Order' utvdjuje se da li je porudzbina poslata
    let allValidCheck = 0;
    // REGULARNI ISKAZI
    document.querySelector("#btnCheck").addEventListener("click", proveriPolje);
  
    function proveriPolje() {
      //RegEx FirstName
      let inpFName = document.querySelector('#inpFName');
      let regInpFName = /^[A-ZČĆŽŠĐ][a-čćžšđ]{2,14}(\s[A-ZČĆŽŠĐ][a-čćžšđ]{2,14})*$/
      if (regInpFName.test(inpFName.value)) {
        inpFName.nextElementSibling.classList.add('correct');
        inpFName.nextElementSibling.innerHTML = "Valid entry";
        allValidCheck++;
  
      }
      else {
        inpFName.nextElementSibling.classList.remove('correct');
        inpFName.nextElementSibling.classList.add('mistake');
        inpFName.nextElementSibling.innerHTML = "The first letter must be uppercase and the name can only contain letters.";
      }
  
      //RegEx LastName
      let inpLName = document.querySelector('#inpLName');
      let regInpLName = /^[A-ZČĆŽŠĐ][a-čćžšđ]{2,14}(\s[A-ZČĆŽŠĐ][a-čćžšđ]{2,14})*$/
      if (regInpLName.test(inpLName.value)) {
        inpLName.nextElementSibling.classList.add('correct');
        inpLName.nextElementSibling.innerHTML = "Valid entry";
        allValidCheck++;
      }
      else {
        inpLName.nextElementSibling.classList.remove('correct');
        inpLName.nextElementSibling.classList.add('mistake');
        inpLName.nextElementSibling.innerHTML = "The first letter must be uppercase and the last name can only contain letters.";
      }
  
      try {
        //RegEx Address
        let inpAddress = document.querySelector('#inpAddress');
        let regInpAddress = /^((ul\.|ulica)\s)?([A-ZČĆŽŠĐ][a-zčćžšđ]{1,24}\s)+(([1-9][0-9]?[A-Z])|bb)$/
        if (regInpAddress.test(inpAddress.value)) {
          inpAddress.nextElementSibling.classList.add('correct');
          inpAddress.nextElementSibling.innerHTML = "Valid entry";
          allValidCheck++;
        }
        else {
          inpAddress.nextElementSibling.classList.remove('correct');
          inpAddress.nextElementSibling.classList.add('mistake');
          inpAddress.nextElementSibling.innerHTML = `A few examples to help you:</br>ul. Nikole Nikolića 15B</br>ulica Nikole Nikolića bb</br>Nikole Nikolića 88A`;
        }
  
        //RegEx Address Optional
        let inpAddress2 = document.querySelector('#inpAddress2');
        let regInpAddress2 = /^(((ul\.|ulica)\s)?([A-ZČĆŽŠĐ][a-zčćžšđ]{1,24}\s)+(([1-9][0-9]?[A-Z])|bb))?$/
        if (regInpAddress2.test(inpAddress2.value)) {
          inpAddress2.nextElementSibling.classList.add('correct');
          inpAddress2.nextElementSibling.innerHTML = "Valid entry";
          allValidCheck++;
        }
        else {
          inpAddress2.nextElementSibling.classList.remove('correct');
          inpAddress2.nextElementSibling.classList.add('mistake');
          inpAddress2.nextElementSibling.innerHTML = `Format:</br>(ul. or ulica) Address Name (address num. or bb)`;
        }
  
        //RegEx Phone AreaCode
        let inpAreaCode = document.querySelector('#inpAreaCode');
        let regInpAreaCode = /^\+38[12579]$/
        if (regInpAreaCode.test(inpAreaCode.value)) {
          inpAreaCode.nextElementSibling.classList.add('correct');
          inpAreaCode.nextElementSibling.innerHTML = "Valid entry";
          allValidCheck++;
        }
        else {
          inpAreaCode.nextElementSibling.classList.remove('correct');
          inpAreaCode.nextElementSibling.classList.add('mistake');
          inpAreaCode.nextElementSibling.innerHTML = `Must contain numbers from this set +38[12579]`;
        }
  
        //shipment Date
        let sDate = new Date();
        let day = sDate.getDay();
        let date = sDate.getDate();
        let month = sDate.getMonth() + 1;
        let year = sDate.getFullYear();
  
        let shipmentDate = document.querySelector('#shipmentDate');
  
        switch (day) {
          case 0: shipmentDate.value = `Monday, ${date + 1}.${month}.${year}. - Wednesday, ${date + 3}.${month}.${year}.`; break;
          case 1: shipmentDate.value = `Thuesday, ${date + 1}.${month}.${year}. - Thursday, ${date + 3}.${month}.${year}.`; break;
          case 2: shipmentDate.value = `Wednesday, ${date + 1}.${month}.${year}. - Friday, ${date + 3}.${month}.${year}.`; break;
          case 3: shipmentDate.value = `Thursday, ${date + 1}.${month}.${year}. - Saturday, ${date + 3}.${month}.${year}.`; break;
          case 4: shipmentDate.value = `Friday, ${date + 1}.${month}.${year}. - Sunday, ${date + 3}.${month}.${year}.`; break;
          case 5: shipmentDate.value = `Saturday, ${date + 1}.${month}.${year}. - Monday, ${date + 3}.${month}.${year}.`; break;
          case 6: shipmentDate.value = `Sunday, ${date + 1}.${month}.${year}. - Tuesday, ${date + 3}.${month}.${year}.`;
        }
  
        //RegEx Credit Card Number
        let inpCardId = document.querySelector('#cardId');
        let regInpCardId = /^[1-9][0-9]{3}\-[1-9][0-9]{3}\-[1-9][0-9]{3}\-[1-9][0-9]{3}$/
  
        if (regInpCardId.test(inpCardId.value)) {
          inpCardId.nextElementSibling.classList.add('correct');
          inpCardId.nextElementSibling.innerHTML = "Valid entry";
          allValidCheck++;
        }
        else {
          inpCardId.nextElementSibling.classList.remove('correct');
          inpCardId.nextElementSibling.classList.add('mistake');
          inpCardId.nextElementSibling.innerHTML = `Wrong format credit card number, cannot contain letters and must contain '-' between 4 numbers.`;
        }
  
        //RegEx Card Owner
        let inpcardOwner = document.querySelector('#cardOwner');
        let regInpcardOwner = /^[A-ZČĆŽŠĐ]{3,14}\s[A-ZČĆŽŠĐ]{3,14}$/
  
        if (regInpcardOwner.test(inpcardOwner.value)) {
          inpcardOwner.nextElementSibling.classList.add('correct');
          inpcardOwner.nextElementSibling.innerHTML = "Valid entry";
          allValidCheck++;
        }
        else {
          inpcardOwner.nextElementSibling.classList.remove('correct');
          inpcardOwner.nextElementSibling.classList.add('mistake');
          inpcardOwner.nextElementSibling.innerHTML = `Contains only capital letters</br>Format: First Name and Last Name`;
        }
  
        //RegEx CVV2
        let inpCvv2Id = document.querySelector('#cvv2Id');
        let regInpCvv2Id = /^[0-9]{3,4}$/
  
        if (regInpCvv2Id.test(inpCvv2Id.value)) {
          inpCvv2Id.nextElementSibling.classList.add('correct');
          inpCvv2Id.nextElementSibling.innerHTML = "Valid entry";
          allValidCheck++;
        }
        else {
          inpCvv2Id.nextElementSibling.classList.remove('correct');
          inpCvv2Id.nextElementSibling.classList.add('mistake');
          inpCvv2Id.nextElementSibling.innerHTML = `3 or 4 digits are allowed`;
        }
      }
      catch (e) {
  
      }
  
      // RegEx Email
      let inpEmail = document.querySelector('#inpEmail');
      let regInpEmail = /^[a-z][\d\w\.]*\@[a-z]{3,}(\.[a-z]{2,4}){1,3}$/
      if (regInpEmail.test(inpEmail.value)) {
        inpEmail.nextElementSibling.classList.add('correct');
        inpEmail.nextElementSibling.innerHTML = "Valid entry";
        allValidCheck++;
      }
      else {
        inpEmail.nextElementSibling.classList.remove('correct');
        inpEmail.nextElementSibling.classList.add('mistake');
        inpEmail.nextElementSibling.innerHTML = `Format:</br>example.example@example.eg</br>First character must be lowercase letter, email can contain numbers.`;
      }
  
  
      //RegEx Phone Number
      let inpPhone = document.querySelector('#inpPhone');
      let regInpPhone = /^06[0-9]{7,8}$/
      if (regInpPhone.test(inpPhone.value)) {
        inpPhone.nextElementSibling.classList.add('correct');
        inpPhone.nextElementSibling.innerHTML = "Valid entry";
        allValidCheck++;
      }
      else {
        inpPhone.nextElementSibling.classList.remove('correct');
        inpPhone.nextElementSibling.classList.add('mistake');
        inpPhone.nextElementSibling.innerHTML = `The mobile number starts with 06 and has a maximum of 10 digits.`;
      }
      if (allValidCheck >= 11) {
        btnCheck.nextElementSibling.classList.add('correct');
        btnCheck.nextElementSibling.innerHTML = "Order Sent";
      }
      else {
        btnCheck.nextElementSibling.classList.remove('correct');
        btnCheck.nextElementSibling.classList.add('mistake');
        btnCheck.nextElementSibling.innerHTML = 'Check form again';
      }
      allValidCheck = 0;
  
    }
    // STRING SA SVIM POSTANSKIM BROJEVIMA
    var Brojevi = '24430,31203,22244,18228,24425,34325,36203,11261,18226,31312,25212,22202,37230,15211,12370,21473,23217,23333,18220,19250,26310,12221,31307,35270,25260,15353,23207,24217,34303,11313,34300,18423,31230,18207,22418,34216,11423,24416,18315,24309,18330,24321,21420,19347,31258,19209,37265,11235,22225,15318,21400,12311,24300,34212,25275,18415,25242,22208,25252,16201,21234,22327,25272,26364,21470,11325,24343,32243,24415,34209,21465,22222,21217,24417,21429,36201,21226,23234,34226,18209,15358,32255,35204,35224,31250,37244,24210,16240,24331,23270,18257,11426,36344,12305,26324,18436,23332,18445,26234,18252,23242,15233,23216,19204,26314,11312,26327,19322,23237,23202,23251,35236,23315,37227,23213,21227,26320,26373,23312,11318,11424,35268,34304,37246,31337,19340,15316,14242,14214,11567,38216,16204,21312,24211,22303,31251,15362,11400,11460,21422,26205,32211,18426,31243,34205,19317,11504,23305,26367,24435,18432,22256,11565,22245,23316,21245,34227,18229,22251,18251,26222,26226,21220,32210,11279,17529,11308,23206,21411,21216,23232,23311,26340,34313,15313,19300,18310,12242,37253,21314,31311,23245,14246,22422,32259,19311,22306,26322,11223,18000,19366,18205,11461,18366,23205,24311,18424,22203,34312,23218,18411,25224,35263,21431,21300,22330,11000,31320,11050,22304,11070,23272,11060,23236,11010,22322,11000,23330,11000,23313,11000,26353,11090,36300,11030,21000,11080,22323,22242,24223,32305,35271,22212,23273,22324,24351,25270,36216,35238,18250,22254,11500,24206,37266,17522,22417,22253,21423,31241,25250,17546,22416,31325,26230,18420,35267,37226,26204,35217,16233,23274,17557,21427,34308,24408,24344,15350,15213,25245,23263,14225,24207,19372,12317,36341,14253,16205,11314,23252,19378,11307,37281,19370,23326,11275,18312,32312,11251,19210,11212,11211,32242,19229,24342,19231,11213,17540,23325,16232,37257,37262,26215,22217,24413,23243,18363,31322,14213,12313,26000,17537,24330,19315,35250,12206,21434,12222,37201,14201,38266,12225,26333,32256,16251,32303,22410,31234,14207,32213,18413,22415,37231,19216,23260,16253,31256,12205,15304,14244,12300,15309,21131,32307,11282,32253,11226,38157,18300,14212,21469,12230,35247,31305,26360,37220,19207,19313,22420,36346,21428,19323,35212,34228,37238,37225,37237,19369,26229,22421,24313,21242,37243,17520,14206,17567,36215,21209,19362,32251,19321,34301,18326,34217,37214,34242,12372,35273,22428,18368,35254,12307,18260,35249,14221,32000,12375,31310,35207,22231,12000,24220,31210,18417,19330,21413,32308,21233,16222,23266,18365,21311,32212,15224,17523,23215,35264,37210,22442,37208,31330,18232,17511,23320,14251,25210,25263,22326,31300,26213,32252,36321,38213,23328,22257,15355,15306,16215,11280,18304,18400,26323,18433,18313,15215,25220,11413,36220,18255,34322,22404,35230,12254,21238,18440,23335,34210,34305,15321,37271,22206,26214,21225,22441,11311,26225,14211,36307,23221,25254,19334,34321,19314,35213,14202,21468,11327,26316,21299,36305,11233,18320,34302,14222,38267,14204,12304,31236,12315,22232,35206,34204,36350,11272,25283,12224,37236,18408,11411,15235,36212,26354,25253,22412,18246,18314,35235,18410,31206,26227,23212,19213,22205,15317,21471,19352,31265,11326,37215,17544,37223,35255,16252,15323,35260,18404,17556,34314,35237,18421,34225,35258,19214,18414,35220,15227,37259,18254,15310,17547,36309,19345,37205,18242,25280,37258,11232,19220,17521,17526,26331,25243,36205,14203,11453,15311,31255,15226,31237,31317,19318,34231,31208,35272,19257,35262,36353,35265,32313,38239,36222,11506,11566,18223,22400,35257,21201,15212,16223,15324,11194,11432,25233,15359,23314,12255,18224,26224,15000,18406,23324,12207,21244,11561,26206,36312,19224,18237,22204,37202,36202,26328,26350,34215,23331,21239,11315,24213,18235,19335,19373,37206,19379,17514,22425,18405,16213,23203,31335,23208,19377,34207,21467,22230,31262,23264,23240,24323,35211,21410,26203,32300,21425,18240,26351,26223,11407,21432,35233,25282,35234,19228,24400,21247,11433,22258,12309,35261,31205,37251,22440,26202,11454,35222,18311,21412,22240,15356,16246,11316,35256,12223,19225,22308,21433,32232,32311,32225,22310,31214,12373,18425,35203,17538,19326,34206,36208,14243,21214,18202,31207,32215,25223,32306,36310,18241,11509,24406,11322,16244,26228,18204,32224,37221,19324,37234,14245,21237,31244,31313,37239,11508,14223,22423,11420,38205,11300,18321,18323,19205,12312,37229,38217,16220,18230,26347,25000,18213,25264,18219,36308,22213,11450,19342,22243,19341,22000,11306,21480,34202,12253,34230,22413,34232,11253,32230,21208,26335,22247,24312,21205,18208,23220,26370,23233,24414,23334,19236,25244,23235,23204,24410,37212,24411,25284,22427,25240,23323,24340,26207,22300,26352,26232,34203,24224,22250,22305,22320,26371,22406,21206,32250,22329,26233,11324,26343,36311,31314,14255,14226,22405,26201,35215,31306,21212,19304,11564,15308,15354,11412,34307,35000,37242,11276,34323,22248,26345,26362,18332,23250,35269,34318,38236,23230,17512,35241,19303,26346,11507,31319,36343,37252,35209,22409,24000,23327,18227,18206,22414,17531,18322,31215,19376,34309,35228,26363,11271,32222,22307,31213,17530,18234,23254,36345,21313,35205,23244,34211,12322,18258,17508,18253,25211,11562,35210,21241,15221,26212,25265,26329,16212,19353,35259,31257,18360,11130,32304,32206,23209,15222,24214,14252,15234,18324,19325,24420,25222,32234,21235,37256,18355,21421,18212,24308,21240,31204,23222,25255,23262,22443,34310,18225,12226,24104,34243,24205,23214,24407,24352,23300,24427,21211,21424,19320,32205,23211,24426,22424,35248,17524,17525,12258,32221,15357,37235,12209,19306,17535,15303,25221,37240,19222,18211,34240,16247,23265,16231,19350,21215,19316,36320,15220,14210,31318,36313,35242,32314,11431,11277,25274,26330,14254,11430,23253,11260,36340,19305,35219,36342,37254,24437,36354,26216,19223,31000,11415,15319,17545,11262,19329,21426,15302,14000,34224,31263,18216,15232,40000,37260,16206,22241,31260,19367,38210,26337,31254,16221,12208,19328,32235,37245,11409,26366,26210,11414,21243,19235,32257,11408,26220,37209,34000,18403,23231,11320,22411,15322,36000,37233,22325,11462,31242,11563,12316,26365,17543,19206,37282,35223,24341,22211,19219,37204,19375,18215,22314,37207,11319,12220,18307,34214,15314,12306,35227,11323,25225,12314,26380,26334,31233,34306,22328,21203,37000,21246,18409,11351,12240,12229,21466,32254,37255,24222,22224,22246,25230,18306,18214,36206,21472,36207,23271,22431,37222,37213,26368,17510,22419,15225,25262,26315,18435,26332,18430,17507,11425,17532,26349,17533,32258,17534,35226,11406,26336,12371,22223,16210,22221,11328,37232,22429,36204,22313,14224,35208,25234,23219,18201,26338,34220,12256,34223,26348,11550,32315,23241,11427,12321,17500,16230,17542,16248,11329,21207,19344,14205,19312,19343,36214,37224,21460,17513,23329,43500,11224,38219,22408,16000,11560,15307,36210,11309,36217,22207,26300,18245,16203,25232,12318,11310,21230,15305,12374,14240,32223,22255,34244,18217,11505,31209,12320,15320,15315,22321,19000,24215,18244,21248,22201,26361,15312,24322,37203,15300,11080,11317,36221,19208,34229,32240,23210,21315,18210,11321,18407,19234,18412,36306,37228,23261,31315,23224,23255,18437,31253,19371,19215,21213,15352,23000,38228,18438,11225,43000,19227,18333';
    // STRING SVIH MESTA ZA ODGOVARAJUCE POSTANSKE BROJEVE
    var naziviGradova = 'Ada, Lunovo Selo, Adaševci, Lužane, Adorjan, Lužnice, Adrani, Mala Moštanica,Aleksinacki Rudnik, Mačkat, Aleksa Šantić, Mačvanska Mitrovica, Aleksandrovac, Mačvanski Pričinović, Aleksandrovac, Maglić,Aleksandrovo, Majdan,Aleksinac, Majdanpek,Alibunar, Majilovac,Aljinovici, Majur,Apatin, Majur,Aradac, Mala Bosna,Aranđelovac, Mala Krsna,Aranđelovac, Mala Plana,Arilje, Malča,Asanja, Male Pčelice,Azanja, Male Pijace,Babin Kal, Mali Beograd,Babušnica, Mali Idjoš,Bač, Mali Izvor,Bačevci, Mali Jasenovac,Bačina, Mali Požarevac,Bacinci, Mali Zvornik,Bačka Palanka, Malo Crniće, Bačka Topola, Malo Krcmare, Bački Breg, Malošište, Bački Brestovac, Manđelos, Bački Gračac, Manojlovce, Bački Jarak, Maradik, Bački Monoštor, Margita, Bački Petrovac, Markovac, Bački Sokolac, Markovica, Bački Vinogradi, Maršić, Bačko Dobro Polje, Martinci, Bačko Gradište, Martonoš, Bačko Novo Selo, Mataruška Banja, Bačko Petrovo Selo, Međa, Badnjevac, Medoševac, Badovinci, Međurečje, Bagrdan, Medveđa, Bajina Bašta, Medveđa, Bajmok, Medveđa, Bajša, Melenci, Balajinac, Meljak, Baljevac Na Ibru, Melnica, Banatska Palanka, Merćez, Banatsko Aranđelovo, Merdare, Banatski Brestovac, Merošina, Banatski Despotovac, Metlić, Banatsko Karađorđevo, Metovnica, Banatsko Novo Selo, Mihajlovac, Banatska Subotica, Mihajlovac, Banatsko Višnjićevo, Mihajlovo, Banatska Dubica, Mijatovac, Banatska Topola, Milentija, Banatski Dvor, Mileševo, Banatski Karlovac, Miletićevo, Banatsko Veliko Selo, Miloševac, Baničina, Miloševo, Banja, Milutovac, Banja Kod Priboja, Minićevo, Banja Koviljača, Mionica, Banjani, Mirosaljci, Banjska, Miroševce, Banoštor, Mišićevo, Banovci Dunav, Mitrovac, Banovo Polje, Mladenovac, Barajevo, Mladenovo, Baranda, Mojsinje, Barbatovac, Mokra Gora, Bare, Mokranja, Barič, Mokrin, Barice, Mol, Barlovo, Molovin, Baroševac, Morović, Bašaid, Mošorin, Batočina, Mozgovo, Batrovci, Mramor, Bavanište, Mramorak, Bečej, Mrčajevci, Bečmen, Muhovac, Begaljica, Muzlja, Begeč, Nadalj, Begejci, Nakovo, Bela Crkva, Natalinci, Bela Crkva, Negotin, Bela Palanka, Neresnica, Bela Voda, Neštin,Bela Zemlja, Neuzina,Belanovica, Nikinci,Bele Vode, Nikolićevo,Belegiš, Nikolinci,Beli Potok, Niš,Beli Potok, Niška Banja,Beljina, Niševac,Belo Blato, Njegoševo,Beloljin, Noćaj,Belosavci, Nova Crnja,Belotinac, Nova Crvenka, Belušić, Nova Gajdobra, Beočin, Nova Pazova,Beograd, Nova Varoš,Beograd Zvezdara, Novi Banovci,Novi Beograd, Novi Bečej,Beograd Palilula, Novi Itebej,Beograd Voždovac, Novi Karlovci,Beograd Savski Venac, Novi Kneževac,Beograd Stari Grad, Novi Kozarci,Beograd Vračar, Novi Kozjak,Beograd Rakovica, Novi Pazar,Beograd Čukarica, Novi Sad,Beograd Zemun, Novi Slankamen,Berkasovo, Novi Žednik,Beršići, Novo Lanište,Bešenovo, Novo Miloševo,Beška, Novo Orahovo,Bezdan, Novo Selo,Bigrenica, Novo Selo,Bikić Do, Obrenovac,Bikovo, Obrez,Biljača, Obrez,Bingula, Obrovac,Bioska, Odžaci,Bistar, Ogar,Bistrica, Omoljica,Blace, Oparić,Blaževo, Opovo,Bobovo, Orane,Bočar, Oraovica,Bođani, Orašac,Bogaraš, Orešković,Bogatić, Orid,Bogojevo, Orlovat,Bogovađa, Orom,Bogovina, Osanica,Bogutovac, Osečina,Bojnik, Osipaonica,Boka, Osnić,Boleč, Osreci,Boljevac, Ostojićevo,Boljevci, Ostrovica,Boljkovci, Ostružnica,Bor, Ovča,Borča, Ovčar Banja,Borski Brestovac, Pačir, Borsko Bučje, Padinska Skela, Bosilegrad, Padej, Bošnjace, Padež, Bošnjane, Padina, Bosut, Palić, Botoš, Palilula, Božetići, Pambukovica, Boževac, Pančevo,Božica, Panonija,Braćevac, Paraćin,Bradarac, Parage,Braničevo, Parunovac,Brankovina, Pasjane,Bratinac, Pavliš,Bratljevo, Pecanjevce,Brđani, Pećinci,Brekovo, Pećka,Bresnica, Pejkovac,Brestač, Pepeljevac,Brestovačka Banja, Perlez,Brestovac, Perućac,Brežane, Petlovača,Brežđe, Petrovac Na Mlavi,Brezjak, Petrovaradin,Brezna, Petrovcic,Brezova, Pinosava,Brezovica, Pirot,Brgule, Pivnice,Brnjica, Plana,Brodarevo, Plandište,Brus, Planinica,Brusnik, Platičevo,Brvenik, Plavna,Brza Palanka, Plažane,Brzan, Ples,Brzeće, Ploča,Bučje, Pločica,Buđanovci, Pobeda,Budisava, Počekovina,Bujanovac, Poćuta,Bujanovac, Podunavci,Bukovac, Podvis,Bukovica, Podvrška,Bukovik, Poganovo,Bukurovac, Pojate,Bumbarevo Brdo, Poljana,Bunar, Popinci,Burdimo, Popovac,Burovac, Popovac,Busilovac, Popučke,Čačak, Porodin,Čajetina, Potočac,Čalma, Požarevac,Čantavir, Požega,Čečina, Prahovo,Čelarevo, Pranjani,Čenej, Predejane,Ćenta, Prekonoga,Čerević, Preljina,Cerovac, Preševo,Čestereg, Prevešt,Ćićevac, Prhovo,Čitluk, Priboj,Čitluk, Priboj Vranjski,Čoka, Pricevic,Čonoplja, Prigrevica,Čortanovci, Prijepolje,Crepaja, Prilički Kiseljak,Crkvine, Prilužje,Crna Bara, Privina Glava,Crna Bara, Prnjavor Mačvanski,Crna Trava, Progar,Crnoklište, Prokuplje,Crvena Crkva, Prolom,Crvena Reka, Provo,Crvenka, Pružatovac,Čukojevac, Pukovac,Čumić, Putinci,Ćuprija, Rabrovo,Čurug, Rača,Đala, Rača Kragujevačka,Darosava, Radalj,Dasnica, Radenković,Debeljača, Radičević,Deč, Radinac,Deliblato, Radljevo,Delimeđe, Radojevo,Deronje, Radujevac,Desimirovac, Rajac,Despotovac, Rajković,Despotovo, Rakinac,Devojački Bunar, Rakovac,Dezeva, Ralja,Dimitrovgrad, Ranilovic,Divci, Ranilug,Divčibare, Ranovac,Divljaka, Rašanac,Divoš, Raševica,Divostin, Raška,Dobanovci, Rastina,Dobra, Rataje,Dobri Do, Ratari,Dobrić, Ratina,Dobrica, Ratkovo,Dobrinci, Ravna Dubrava,Dolac, Ravna Reka,Doljevac, Ravni,Dolovo, Ravni Topolovac,Donja Bela Reka, Ravnje,Donja Borina, Ravno Selo,Donja Kamenica, Ražana,Donja Livadica, Ražanj,Donja Ljubata, Razbojna,Donja Mutnica, Razgojna,Donja Orovica, Rekovac,Donja Rečica, Reljan,Donja Satornja, Resavica,Donja Trnava, Resnik,Donje Vidovo, Rgotina,Donje Crnatovo, Ribare,Donje Crniljevo, Ribare,Donje Međurovo, Ribari,Donje Tlamino, Ribarice,Donje Zuniće, Ribarska Banja,Donji Dušnik, Ridjica,Donji Krčin, Ripanj,Donji Milanovac, Ristovac,Donji Stajevac, Ritiševo,Doroslovo, Roćevci,Dračić, Rogača,Draginac,Rogačica,Draginje, Roge,Draglica, Rogljevo,Dragobraća, Rožanstvo,Dragocvet, Rudna Glava,Dragoševac, Rudnica,Dragovo, Rudnik,Drajkovce, Rudno,Draževac, Rudovci,Draževac(kod Aleksinca),Ruma,Drenovac,Rumenka,Drenovac,Ruplje,Drlače,Rušanj,Drugovac,Ruski Krstur,Dublje,Rusko Selo,Duboka,Rutevac,Dubovac,Šabac,Dubovo,Sajan,Dubravica,Šajkaš,Dudovica,Sakule,Duga Poljana,Salaš,Dugo Polje,Salaš Noćajski,Đunis,Samaila,Dupljaja,Samoš,Đurdjevo,Sanad,Đurdjevo,Saraorci,Đurđin,Šarbanovac,Dušanovac,Šarbanovac,Dvorane,Šarbanovac Timok,Džep,Šašinci,Džigolj,Sastav Reka,Ečka,Sastavci,Elemir,Savinac,Erdec,Savino Selo,Erdevik,Seča Reka,Farkaždin,Sečanj,Feketić,Sedlare,Futog,Sefkerin,Gornji Milanovac,Selenča,Gadžin Han,Seleuš,Gaj,Selevac,Gajdobra,Senje,Gakovo,Senjski Rudnik,Gamzigradska Banja,Senta,Gardinovci,Šepšin,Gibarac,Šetonje,Glavinci,Sevojno,Globoder,Sibač,Glogonj,Sibnica,Glogovac,Sićevo,Gložan,Šid,Glušci,Sijarinska Banja,Golobok,Sikirica,Golubac,Sikole,Golubinci,Silbaš,Goračići,Šilopaj,Goričani,Šimanovci,Gornja Dobrinja,Simićevo,Gornja Draguša,Siokovac,Gornja Lisina,Sip,Gornja Sabanta,Sirča,Gornja Toplica,Sirig,Gornja Toponica,Sirogojno,Gornja Trepča,Sivac,Gornji Banjani,Sjenica,Gornji Barbeš,Skela,Gornji Breg,Skobalj,Gornji Brestovac,Skorenovac,Gornji Matejevac,Slatina,Gornji Stepoš,Slatina,Gornji Stupanj,Slavkovica,Gospođinci,Šljivovica,Gostilje,Šljivovo,Grabovac,Slovac,Grabovci,Smederevska Palanka,Gračanica,Smederevo,Gradina,Smilovci,Gradskovo,Smoljinac,Graševci,Sočanica,Grdelica,Soko Banja,Grebenac,Sombor,Gredetin,Sonta,Grejač,Sopoćani,Grgurevci,Sopot,Grlište,Sot,Grljan,Sremska Mitrovica,Grocka,Srbobran,Grosnica,Srednjevo,Gruza,Sremski Mihaljevci,Guberevac,Sremčica,Guča,Sremska Kamenica,Gudurica,Sremska Rača,Gunaroš,Sremski Karlovci,Guševac,Srpska Crnja,Hajdučica,Srpski Itebej,Hajdukovo,Srpski Krstur,Halovo,Srpski Miletić,Hetin,Stajićevo,Horgoš,Stalać,Horgoš Granični Prelaz,Stanišić,Hrtkovci,Stapar,Iđos,Stara Moravica,Idvor,Stara Pazova,Ilandža,Starčevo,Ilićevo,Stari Žednik,Ilinci,Stari Banovci,Inđija,Stari Lec,Irig,Stari Ledinci,Ivanjica,Stari Slankamen,Ivanovo,Staro Selo,Izbište,Štavalj,Jablanica,Stave,Jabučje,Stejanovci,Jabuka,Stenjevac,Jabuka,Stepanovićevo,Jabukovac,Stepojevac,Jadranska Lešnica,Štitar,Jagnjilo,Stojnik,Jagodina,Stopanja,Jakovo,Stragari,Jamena,Straža,Janošik,Strelac,Jarkovac,Strižilo,Jarmenovci,Štrpce,Jaša Tomić,Stubal,Jasenovo,Štubik,Jasenovo,Stubline,Jasenovo ,Studenica,Jasika,Subotica Kod Svilajnca,Jazak,Subotica,Jazovo,Subotinac,Jelašnica,Subotište,Jelašnica,Sukovo,Jelen Do,Sumrakovac,Jelovik,Supska,Jermenovci,Surčin,Ježevica,Surduk,Ježevica,Surdulica,Jošanica,Surjan,Jošanička Banja,Susek,Jovac,Sutjeska,Jovanovac,Suvi Do,Jovanovac,Sveti Ilija,Jugbogdanovac,Svetozar Miletić,Junkovac,Svilajnac,Kać,Svileuva,Kačarevo,Svilojevo,Kajtasovo,Svođe,Kalna,Svojnovo,Kaluđerske Bare,Svrljig,Kaluđerica,Takovo,Kamenica,Taraš,Kamenica,Tavankut,Kamenica,Tekeriš,Kamenica,Tekija,Kanjiža,Telečka,Kaona,Temerin,Kaonik,Temska,Karađorđevo,Tešica,Karađorđevo,Titel,Karan,Toba,Karavukovo,Tomaševac,Karlovčić,Topola,Katun,Topolovnik,Kelebija,Toponica,Kelebija-granični prelaz,Torda,Kevi,Tornjoš,Kikinda,Totovo Selo,Kisač,Tovariševo,Kladovo,Trbušani,Klek,Trešnjevac,Klenak,Trešnjevica,Klenike,Trgovište,Klenje,Trnava,Klenje,Trnavci,Kličevac,Trnjane,Klisura,Tršić,Kljajićevo,Trstenik,Klokočevac,Trupale,Knić,Tulare,Knićanin,Turekovac,Knjaževac,Turija,Kobišnica,Tutin,Koceljeva,Ub,Kokin Brod,Ugao,Kolare,Ugrinovci,Kolari,Ugrinovci,Kolut,Uljma,Komirić,Umčari,Konak,Umka,Konarevo,Urovica,Končarevo,Ušće,Konjuh,Utrine,Kopaonik,Uzdin,Koprivnica,Užice,Koraćica,Uzovnica,Korbevac,Velika Moštanica,Korbovo, Vajska,Korenita, Valjevo,Korman, Varda,Korman, Varna,Kosovska Mitrovica, Varvarin,Kosančić, Vasica,Kosjerić, Vasilj,Kosovo Polje, Vatin,Kostojevići, Velika Grabovnica,Kostolac, Velesnica,Kotraža, Velika Drenova,Kovačevac, Velika Greda,Kovačica, Velika Ivanča,Kovilj, Velika Jasikova,Kovilje, Velika Krsna,Kovin, Velika Lomnica,Kragujevac, Velika Plana,Krajišnik, Velika Plana,Kraljevci, Velika Reka,Kraljevo, Velika Vrbnica,Krčedin, Veliki Borak,Kremna, Veliki Crljeni,Krepoljin, Veliki Gaj,Kriva Feja, Veliki Izvor,Kriva Reka, Veliki Popović,Krivaja, Veliki Radinci,Krivelj, Veliki Siljegovac,Krivi Vir, Veliko Bonjince,Krnješevci, Veliko Golovode,Krnjevo, Veliko Gradište,Krupač, Veliko Krčmare,Krupanj, Veliko Laole,Krušar, Veliko Orašje,Krusčić, Veliko Selo,Kruščica, Veliko Središte,Kruščica, Venčane,Krušedol, Veternik,Kruševac, Vilovo,Kruševica, Vinča,Kučevo, Vinci,Kucura, Vionica,Kukljin, Višnjevac,Kukujevci, Višnjićevo,Kula, Visoka Rzana,Kulina, Vitanovac,Kulpin, Vitkovac,Kumane, Vitojevci,Kupci, Vitoševac,Kupinik, Vladičin Han,Kupinovo, Vladimirci,Kupušina, Vladimirovac,Kuršumlijska Banja, Vlajkovac,Kuršumlija, Vlase,Kusadak, Vlasina Okruglica,Kusić, Vlasina Rid,Kušići, Vlasina Stojkovićevo,Kušiljevo, Vlaška,Kuštilj, Vlaški Do,Kuzmin, Vlasotince,Laćarak, Vodanj,Laćisled, Voganj,Lađevci, Vojka,Lajkovac, Vojska,Lalić, Vojvoda Stepa,Lalinac, Vojvodinci,Lapovo, Voluja,Lapovo Selo, Vračev Gaj,Lazarevac, Vračevšnica,Lazarevo, Vranić,Laznica, Vranje,Lebane, Vranjska Banja,Lece, Vranovo,Ledinci, Vratarnica,Lelić, Vražogrnac,Lenovac, Vrba,Lepenac, Vrbas,Lepenica, Vrbica,Leposavić, Vrčin,Lešak, Vrdnik,Leskovac, Vreoci,Lešnica, Vrnjačka Banja,Leštane, Vrnjci,Ležimir, Vršac,Lički Hanovi, Vučje,Lipar, Vukovac,Lipe, Žabalj,Lipolist, Žabari,Ljig, Zablaće,Ljuba, Zabojnica,Ljuberadja, Zabrežje,Ljubiš, Žagubica,Ljubovija, Zajača,Ljukovo, Zaječar,Ljutovo, Zaplanjska Toponica,Lok, Zasavica,Lokve, Zavlaka,Lovćenac, Zdravinje,Loznica, Zemun,Lozovik, Žiča,Lubnica, Žirovnica,Lučani, Žitište,Lug, Žitkovac,Lugavčina, Žitni Potok,Luka, Žitorađa,Lukare, Zlatari,Lukićevo, Zlatibor,Lukino Selo, Zlatica,Lukovo, Zlodol,Lukovo, Zlot, Zmajevo, Zminjak, Zrenjanin, Zubin Potok, Žuč, Zuce, Zvečan, Zvezdan, Zvonce,';
  
    // PRETVARANJE U NIZ
    let brojevi = Brojevi.split(',');
    let gradovi = naziviGradova.split(',');
  
    let btn = document.querySelector('#btnCheckPostalCode');
    btn.addEventListener('click', function () {
  
      //RegEx Postal Code 
      let inpPostalCode = document.querySelector("#inpPostalCode");
      let postalvalue = inpPostalCode.value;
  
  
      let regInpPostalCode = /^[1-9][0-9]{4}$/
  
      if (regInpPostalCode.test(postalvalue)) {
        for (let i = 0; i < brojevi.length; i++) {
          if (postalvalue == brojevi[i]) {
            outputCity.value = gradovi[i];
            inpPostalCode.nextElementSibling.classList.remove('mistake');
            inpPostalCode.nextElementSibling.classList.add('correct');
            inpPostalCode.nextElementSibling.innerHTML = "Valid entry";
            allValidCheck++;
            break;
          }
          else if (i == brojevi.length - 1) {
            outputCity.value = 'Greska';
            inpPostalCode.nextElementSibling.classList.remove('correct');
            inpPostalCode.nextElementSibling.classList.add('mistake');
            inpPostalCode.nextElementSibling.innerHTML = `Can't find place with that postal code`;
          }
        }
        if (outputCity.value == 'Your locality will be displayed here') {
          outputCity.value = 'Greska';
          inpPostalCode.nextElementSibling.classList.remove('correct');
          inpPostalCode.nextElementSibling.classList.add('mistake');
          inpPostalCode.nextElementSibling.innerHTML = `Enter Postal Code</br>Contains 5 digits, first can't be 0`;
        }
      }
      else {
        outputCity.value = 'Greska';
        inpPostalCode.nextElementSibling.classList.remove('correct');
        inpPostalCode.nextElementSibling.classList.add('mistake');
        inpPostalCode.nextElementSibling.innerHTML = `Enter Postal Code</br>Contains 5 digits, first can't be 0`;
      }
    })
  }
  catch (e) { }
  
  ////////////////// FOOTER /////////////////////////
  // jQueary PLUGIN PREUZET SA https://www.jqueryscript.net/animation/footer-reveal-animation-scroll.html
  var ispis2 = '';
  var icons = new Array('fa fa-facebook', 'fa fa-pinterest-p', 'fa fa-instagram', 'fa fa-linkedin', 'fa fa-book', 'fa fa-rss');
  var linkSocial = new Array("https://www.facebook.com/", 'https://www.pinterest.com/', 'https://www.instagram.com/', 'https://www.linkedin.com/', 'documentation.pdf', 'news.xml')
  for (var i = 0; i < icons.length; i++) {
    ispis2 += `
      <li><a href='${linkSocial[i]}' target='_blank'><i class="${icons[i]}" aria-hidden="true"></i>
    `
  }
  document.querySelector(".social").innerHTML = ispis2;
  
  //End
  //Footer jQueary Plugin
  var logoElement = $('footer .logo');
  
  $(window).scroll(function () {
  
    if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
  
      $(logoElement).addClass('show');
  
    } else if ($(logoElement).hasClass('show') && $(window).scrollTop() + $(window).height() > $(document).height() - 150) {
  
      $(logoElement).removeClass('show');
  
    }
  });
  //End
  