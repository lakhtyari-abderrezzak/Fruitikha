document.querySelector('.dropbtn').addEventListener('click', function() {
    document.getElementById('myDropdown').classList.toggle('show');
});

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// Cart Script

const price = document.querySelector('#product-price');
const quantity = document.querySelector('#product-quantity');
let total = document.querySelector('#product-total');
    console.log(price.innerText);
    console.log(quantity.innerText);
    console.log(total.innerText);

// function totl(){
//     total.innerText = price.innerText * quantity.innerText;
//     console.log(price);
// }
// totl();