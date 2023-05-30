$('.game-link').mouseenter((ev) => {
    let box = ev.target
    color(box, true)
    //setColor($(box).find('.size').find('img'), true, box)
    if (box.classList.contains('game-link')) {
        box.dataset.hover = "1"
        changeColor(box)
    }
})

$('.game-link').mouseleave((ev) => {
    let box = ev.target
    if (box.classList.contains('game-link')) {
        box.dataset.hover = "0"
    }
})

function changeColor(box) {
    setTimeout(() => {
        if (box.classList.contains('game-link')) {
            color(box, true)
            //setColor($(box).find('.size').find('img'), true, box)
            if (box.dataset.hover === "1")
                changeColor(box)
        }
    }, 800)
}