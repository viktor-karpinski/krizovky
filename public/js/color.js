const colors = ['#673ab7', '#e91e63', '#4caf50', '#00bcd4', '#f57249', '#e935c2']

function color(id, border) {
    let box = $(id)

    if (border) {
        box.css({'border-color': colors[Math.floor(Math.random()*colors.length)]})
    } else {
        box.css({'background-color': colors[Math.floor(Math.random()*colors.length)]})
    }
}

function getColor() {
    return $('header').attr('style').split(':')[1].trim().slice(0, -1)
}

function getBoxColor(box) {
    return $(box).attr('style').split(':')[1].trim().slice(0, -1)
}

function hrColor(id, border) {
    let box = $(id)
    let hr = getColor()

    if (border) {
        box.css({'border-color': hr})
    } else {
        box.css({'background-color': hr})
    }
}

function setColor(id, border, box) {
    let copy = $(id)
    let hr = getBoxColor(box)

    if (border) {
        copy.css({'border-color': hr})
    } else {
        copy.css({'background-color': hr})
    }
}

//color('#hr', false)

