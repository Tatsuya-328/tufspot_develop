class ReadMore {
    constructor(articleContainer, postCards, readMoreButtons) {
        this.articleContainer = articleContainer;
        this.postCards = postCards;
        this.readMoreButtons = readMoreButtons;
        this.isClicked = false;
    }

    clickReadMore() {
        this.readMoreButtons.forEach(readMoreButton => {
            readMoreButton.addEventListener('click', () => {
                if (window.innerWidth <= 425) {
                    const targetElement = this.articleContainer.querySelector('.top_pickup_title_link');
                    const redirectLink = targetElement.getAttribute('href');
                    window.location.href = redirectLink;
                } else if (window.innerWidth <= 1199) {
                    if (this.isClicked === true) {
                        const targetElement = this.articleContainer.querySelector('.top_pickup_title_link');
                        const redirectLink = targetElement.getAttribute('href');
                        window.location.href = redirectLink;
                        return;
                    }

                    let removeHiddenCount = 0;
                    this.postCards.forEach(postCard => {
                        if (postCard.classList.contains('hidden') && removeHiddenCount <= 3) {
                            postCard.classList.remove('hidden');
                            removeHiddenCount++;
                            this.isClicked = true;
                        }
                    });
                } else {
                    if (this.postCards[this.postCards.length - 1].classList.contains('hidden')) {
                        this.postCards.forEach(postCard => {
                            postCard.classList.remove('hidden');
                        });

                        this.articleContainer.querySelector('.blur-back').style.position = 'relative';
                        this.articleContainer.querySelector('.blur-back').style.height = '100px';
                    } else {
                        const targetElement = this.articleContainer.querySelector('.top_pickup_title_link');
                        const redirectLink = targetElement.getAttribute('href');
                        window.location.href = redirectLink;
                    }
                }
            });
        });
    }
}

export default ReadMore;
