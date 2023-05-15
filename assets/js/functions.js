function itemShow() {
    let item = document.getElementById('item_toggle')
    if (item.style.display === 'flex') {
        item.style.display = 'none'
    } else {
        item.style.display = 'flex'
    }
}
