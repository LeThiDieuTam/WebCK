let moon = document.getElementById("moon");
let text = document.getElementById("text");
let train = document.getElementById("train");
let man = document.getElementById("man");
let moon1 = document.getElementById("moon1");

window.addEventListener("scroll", () => {
    let value = window.scrollY;

    // Di chuyển moon lên xuống
    moon.style.marginTop = (100 + value * 0.5) + "px"; 

    // Di chuyển waterfall (thay đổi vị trí nếu cần)

    // Di chuyển man
    man.style.transform = `translate(${value * .3}px, 0)`; // Điều chỉnh giá trị để thay đổi tốc độ di chuyển

    // Di chuyển train nếu có
    if (train) {
        train.style.left = value * 1.5 + 'px'; 
        moon1.style.marginTop = (100 + value * 0.5) + "px"; 

        // Điều chỉnh tỷ lệ di chuyển

    }
});