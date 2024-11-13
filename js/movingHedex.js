var hedexPicture = document.getElementById("hedexPicture");
hedexPicture.onmousemove = (e) => {
    var rect = hedexPicture.getBoundingClientRect();
    
    mouseX = e.pageX - rect.x;
    mouseY = e.pageY - rect.y;
    topDiff = mouseY / (rect.height / 2)
    if(topDiff > 1) topDiff = 1 - (topDiff - 1);
    if(topDiff < 0) topDiff = 0;
    mouseXCenter = Math.round(mouseX - (rect.width / 2));
    diff = rect.width / 2 / 3;
    mod = mouseXCenter/3;
    if(mouseXCenter < 0) mod = mod + diff;
    else mod = mod - diff;
    mod = mod * topDiff;

    hedexPicture.style.transform = `rotateY(${mod}deg)`;
};
hedexPicture.onmouseleave = (e) =>{
    hedexPicture.style.transform = `rotateY(0deg)`;
}