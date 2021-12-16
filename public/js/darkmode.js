let Mode = localStorage.getItem('Mode');
const enableDarkMode = () => {
    $('#html').addClass('dark');
    localStorage.setItem('Mode', 'dark');
}
const disableDarkMode = () => {
    $('#html').removeClass('dark');
    localStorage.setItem('Mode', null);
}

if (Mode === 'dark'){
    enableDarkMode();
    $('#toggle').html('<i class="far fa-sun text-amber-500 font-extralight"></i>');
    $('#toggle').val('light');
} 

$('#toggle').click(function(){
    Mode = localStorage.getItem('Mode');
    console.log(Mode);
    console.log('hi');
    if($('#toggle').val() == 'dark'){
        $('#toggle').html('<i class="far fa-sun text-amber-500 font-light"></i>');
        $('#toggle').val('light');
        enableDarkMode();
    } else if($('#toggle').val() == 'light') {
        $('#toggle').html('<i class="far fa-moon-stars"></i>');
        $('#toggle').val('dark');
        disableDarkMode();
    }
})