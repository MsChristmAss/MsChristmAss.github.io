let cart = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(productName, price) {
    const product = { name: productName, price: price };
    cart.push(product);
    updateCart();
}

function updateCart() {
    const cartCountElement = document.getElementById('cart-count');
    const cartItemsElement = document.getElementById('cart-items');

    cartCountElement.innerText = cart.length;

    if (cartItemsElement) {
        cartItemsElement.innerHTML = '';
        if (cart.length === 0) {
            cartItemsElement.innerHTML = '<p>Ваша корзина пуста.</p>';
        } else {
            cart.forEach((item, index) => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';

                const itemName = document.createElement('span');
                itemName.innerText = item.name;
                cartItem.appendChild(itemName);

                const itemPrice = document.createElement('span');
                itemPrice.innerText = `${item.price} рублей`;
                cartItem.appendChild(itemPrice);

                const removeButton = document.createElement('button');
                removeButton.className = 'remove-btn';
                removeButton.innerText = 'Удалить';
                removeButton.onclick = () => removeFromCart(index);
                cartItem.appendChild(removeButton);

                cartItemsElement.appendChild(cartItem);
            });
        }
    }

    localStorage.setItem('cart', JSON.stringify(cart));
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
}

function showOrderForm() {
    const orderFormSection = document.getElementById('order-form');
    orderFormSection.style.display = 'block';
}

function submitOrder() {
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;

    if (cart.length > 0) {
        cart.forEach((item) => {
            const orderData = {
                name: name,
                phone: phone,
                email: email,
                address: address,
                productName: item.name,
                price: item.price
            };
            fetch('save_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(orderData)
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
        cart = [];
        updateCart();
        alert('Заказ успешно оформлен!');
    } else {
        alert('Ваша корзина пуста.');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    updateCart();

    const checkoutButton = document.getElementById('checkout-button');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', showOrderForm);
    }

    const submitOrderButton = document.getElementById('submit-order-button');
    if (submitOrderButton) {
        submitOrderButton.addEventListener('click', submitOrder);
    }



    //save_blog
    const addBlogButton = document.getElementById('add-blog-button');
    const addBlogFormSection = document.getElementById('add-blog-form');
    const submitBlogButton = document.getElementById('submit-blog-button');

    if (addBlogButton) {
        addBlogButton.addEventListener('click', () => {
            addBlogFormSection.style.display = 'block';
        });
    }

    if (submitBlogButton) {
        submitBlogButton.addEventListener('click', () => {
            const username = document.getElementById('username').value;
            const topic = document.getElementById('topic').value;
            const description = document.getElementById('description').value;

            const blogData = {
                username: username,
                topic: topic,
                description: description
            };

            fetch('save_blog.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(blogData)
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    alert('Блог успешно добавлен!');
                    // Reset form
                    document.getElementById('new-blog-form').reset();
                    addBlogFormSection.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }
    // Загрузка блогов
    function loadBlogs() {
        fetch('load_blogs.php')
            .then(response => response.json())
            .then(data => {
                const blogList = document.getElementById('blog-list');
                blogList.innerHTML = '';
                data.forEach(blog => {
                    const blogPost = document.createElement('div');
                    blogPost.classList.add('blog-post');
                    blogPost.innerHTML = `
                        <h3>${blog.topic}</h3>
                        <p>Автор: ${blog.username}</p>
                        <p>${blog.description}</p>
                    `;
                    blogList.appendChild(blogPost);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Добавление обработчика для кнопки загрузки блогов
    //if (loadBlogsButton) {
    //    loadBlogsButton.addEventListener('click', () => {
    //        loadBlogs();
    //    });
    //}
});