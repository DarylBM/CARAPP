const products = [
    {
      name: 'Product 1',
      price: 19.99,
      image: 'product1.jpg',
      description: 'Description of Product 1'
    },
    {
      name: 'Product 2',
      price: 29.99,
      image: 'product2.jpg',
      description: 'Description of Product 2'
    },
    {
      name: 'Product 3',
      price: 39.99,
      image: 'product3.jpg',
      description: 'Description of Product 3'
    }
  ];
  
  const productList = document.getElementById('products-list');
  
  products.forEach(product => {
    const productCard = document.createElement('div');
    productCard.classList.add('product-card');
  
    productCard.innerHTML = `
      <img src="${product.image}" alt="${product.name}">
      <h2>${product.name}</h2>
      <p>${product.description}</p>
      <p>Price: $${product.price.toFixed(2)}</p>
      <button>Add to Cart</button>
    `;
  
    productList.appendChild(productCard);
  });
  