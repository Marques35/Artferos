const itemsContainer = document.querySelector("#items");

itemsContainer.addEventListener("wheel", event => {
    event.preventDefault();  // Prevent the default scroll behavior
    if(event.deltaY > 0){
        itemsContainer.scrollBy({
            left: 1000, // Adjust the value to change the scroll amount
            behavior: 'smooth'
            
        });
    }else{
        itemsContainer.scrollBy({
            left: -1000, // Adjust the value to change the scroll amount
            behavior: 'smooth'
        });
    }
});

// Automatic scrolling
let autoScrollInterval = setInterval(() => {
    itemsContainer.scrollBy({
        left: 1000, // Adjust the value to change the scroll amount
        behavior: 'smooth'
    });

    // Check if we've reached the end and reset to the beginning if so
    if (itemsContainer.scrollLeft + itemsContainer.clientWidth >= itemsContainer.scrollWidth) {
        itemsContainer.scrollTo({ left: 0, behavior: 'smooth' });
    }
}, 4000); // Change the interval (3000ms = 3s) as needed

// Stop automatic scrolling on user interaction
itemsContainer.addEventListener('wheel', () => {
    clearInterval(autoScrollInterval);
});