document.querySelector('.bannerButton').addEventListener('click', () => {
    document.querySelector('.banner').style.display = 'none';
    document.querySelector('.logoDiv').style.display = 'none';
    document.querySelector('.pageMenu').style.display = 'none';
    document.querySelector('.contentDiv').style.display = 'none';

    document.querySelector('.logoTextForLogo').style.display = 'none';
    document.querySelector('.loginTextMSG').style.display = 'none';
    document.querySelector('.footerDiv').style.display = 'none';


    document.querySelector('.formContainer').style.display = 'flex';

});
    document.querySelector('.x-button').addEventListener('click', () => {
    document.querySelector('.logoDiv').style.display = 'flex';
    document.querySelector('.banner').style.display = 'flex';
    document.querySelector('.pageMenu').style.display = 'flex';
    document.querySelector('.contentDiv').style.display = 'flex';

    document.querySelector('.logoTextForLogo').style.display = 'flex';
    document.querySelector('.loginTextMSG').style.display = 'flex';
    document.querySelector('.footerDiv').style.display = 'block';


    document.querySelector('.formContainer').style.display = 'none';


});
