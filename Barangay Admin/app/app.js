const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});


$(document).ready(function(){

    $('.sub-btn').on('click', function() {

        //rotate arrow from down to right angle
        $(this).find('.dropdown').toggleClass('rotate');

        //rotate arrows back to original except the opened dropdown
        $('.dropdown').not($(this).find('.dropdown')).removeClass('rotate');

        //show dropdown menu when arrow is clicked
        $(this).next('.sub-menu').slideToggle();

        //close dropdown when another sub menu is open
        $('.sub-menu').not($(this).next('.sub-menu')).slideUp();
    });
    
    //logout function
    $('#logoutBtn').on('click', function(){

        $.ajax({
            url: 'INCLUDES-logout.php',
            type: 'POST',
            success: function() {
                window.location.href = "PHP-adminLogin.php";
            },
            error: function(xhr, status, error){
                console.error('Error: ', error);
            }
        });
    });
});