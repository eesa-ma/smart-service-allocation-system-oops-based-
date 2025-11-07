function showServiceDetails() {
            let serviceDetails = document.getElementById("serviceDetails");
            let selectedOption = document.getElementById("request_id").selectedOptions[0];
            
            if (selectedOption.value) {
                serviceDetails.innerHTML = '<i class="fas fa-info-circle"></i> <strong>Service:</strong> ' + 
                                          selectedOption.getAttribute("data-desc");
                serviceDetails.style.display = 'block';
            } else {
                serviceDetails.style.display = 'none';
            }
        }

        // Star Rating Interactive Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating label');
            const ratingText = document.querySelector('.rating-text');
            
            stars.forEach((star, index) => {
                star.addEventListener('click', function() {
                    const rating = 5 - index;
                    updateStarDisplay(rating);
                    updateRatingText(rating);
                });
                
                star.addEventListener('mouseenter', function() {
                    const rating = 5 - index;
                    highlightStars(rating);
                });
            });
            
            const starContainer = document.querySelector('.star-rating');
            starContainer.addEventListener('mouseleave', function() {
                const selectedRating = document.querySelector('.star-rating input:checked');
                if (selectedRating) {
                    const rating = parseInt(selectedRating.value);
                    updateStarDisplay(rating);
                } else {
                    resetStars();
                }
            });
            
            function highlightStars(rating) {
                stars.forEach((star, index) => {
                    if (5 - index <= rating) {
                        star.style.color = '#ffc107';
                        star.style.transform = 'scale(1.1)';
                    } else {
                        star.style.color = '#ddd';
                        star.style.transform = 'scale(1)';
                    }
                });
            }
            
            function updateStarDisplay(rating) {
                stars.forEach((star, index) => {
                    if (5 - index <= rating) {
                        star.style.color = '#ffc107';
                    } else {
                        star.style.color = '#ddd';
                    }
                    star.style.transform = 'scale(1)';
                });
            }
            
            function resetStars() {
                stars.forEach(star => {
                    star.style.color = '#ddd';
                    star.style.transform = 'scale(1)';
                });
            }
            
            function updateRatingText(rating) {
                const ratingLabels = ['Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
                ratingText.innerHTML = `You selected: <strong>${rating} Star${rating > 1 ? 's' : ''}</strong> - ${ratingLabels[rating - 1]}`;
                ratingText.style.color = '#ffc107';
                ratingText.style.fontWeight = '600';
            }
        });