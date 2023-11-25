'use strict';

const pickupTitleImages = document.querySelectorAll('.pickup_title_image');

pickupTitleImages.forEach((pickupTitleImage, index) => {
    if (index % 2 === 0) {
        pickupTitleImage.style.marginLeft = '60%';
    } else {
        pickupTitleImage.style.marginRight = '60%';
        pickupTitleImage.style.marginLeft = 'auto';
    }
});
