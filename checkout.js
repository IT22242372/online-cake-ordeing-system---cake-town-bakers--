let listCart = [];
let deliveryCharges = 350; // Define the delivery charges

function checkCart() {
    var cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('listCart='));
    if (cookieValue) {
        listCart = JSON.parse(cookieValue.split('=')[1]);
    }
}
checkCart();

function addCartToHTML() {
    // Clear data
    let listCartHTML = document.querySelector('.returnCart .list');
    listCartHTML.innerHTML = '';

    let totalQuantityHTML = document.querySelector('.totalQuantity');
    let totalPriceHTML = document.querySelector('.totalPrice');
    let finalTotalPriceHTML = document.querySelector('.finalTotalPrice');
    
    let totalQuantity = 0;
    let totalPrice = 0;

    // If there are products in the cart
    if (listCart) {
        listCart.forEach(product => {
            if (product) {
                let newCart = document.createElement('div');
                newCart.classList.add('item');
                newCart.innerHTML = 
                    `<img src="${product.image}">
                    <div class="info">
                        <div class="name">${product.name}</div>
                        <div class="price">Rs.${product.price}/1 product</div>
                    </div>
                    <div class="quantity">${product.quantity}</div>
                    <div class="returnPrice">Rs.${product.price * product.quantity}</div>`;
                listCartHTML.appendChild(newCart);
                totalQuantity += product.quantity;
                totalPrice += (product.price * product.quantity);
            }
        });
    }

    totalQuantityHTML.innerText = totalQuantity;
    totalPriceHTML.innerText = 'Rs.' + totalPrice;

    // Calculate the final total price including delivery charges
    let finalTotalPrice = totalPrice + deliveryCharges;
    finalTotalPriceHTML.innerText = 'Rs.' + finalTotalPrice;
}
addCartToHTML();
