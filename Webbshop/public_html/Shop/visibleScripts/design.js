/**
 * Created by hannesalbinsson on 2015-03-01.
 */

//---- HEADER ----\\
//---- headerIMG ----\\
$headerImgWidth = $('#headerIMG').width();
$headerImgHeight = ($headerImgWidth * 0.42);
$('#headerIMG').height($headerImgHeight);

//---- headerHeight ----\\
$('#header').height($headerImgHeight);

//---- headerSpaceHeight ----\\
$('#headerSpace').height($headerImgHeight); //the entire headerSpace
$loginSpaceHeight = ($('#headerSpace').height() * 0.8); //fixed height for both #loginSpace and #loggedinSpace
$('#loginSpace').height($loginSpaceHeight);
$('#loggedinSpace').height($loginSpaceHeight);
$('#searchSpace').height(($('#headerSpace').height() * 0.18));

//---- FORMMESSAGEBOX ----\\
$('#formMessageBox').height($('#headerSpace').height() * 0.3);

//---- CATEGORYMENU ----\\
$catMenuNavHeight = $('.catMenuNav').height();
$('.catMenuLi').height($catMenuNavHeight);


//---- ARTICLE ----\\
//---- artBox ----\\
//sets width to always be about a quater of the width of articleSpace
$artSpaceWidth = $('#articleSpace').width();
$artBoxWidth = (($artSpaceWidth * 0.22)); // 1/4 and some marginal
$('.articleObject').width($artBoxWidth);
//adjusts height to always be proportional to width
$artBoxWidth = $('.articleObject').width();
$artBoxHeight = ($artBoxWidth * 1.5);
$('.articleObject').height($artBoxHeight);

//---- artIMG ----\\
$artBoxHeight = $('.articleObject').height();
$artImgHeight = ($artBoxHeight * 0.5);
$('.artIMG').height($artImgHeight);

//---- lowerDiv ----\\
$lowerDivHeight = ($artBoxHeight * 0.1);
$('.lowerDiv').height($lowerDivHeight);     // sets the height for the "lowerDiv"-class
$('.cartButton').height($lowerDivHeight);   //sets the shopping cart button to be the same height as .lowerDiv

//---- PRODUCTPAGE ----\\
$('#ppIMG').height($('#ppIMG').width() * 0.8);
$('#ppBuyInfo').height($('#ppIMG').height());


