function setAddressValues() {
    const input = document.getElementById('addressInput').value;

    const matches = input.match(/\[(.*?)\]/g);

    if (matches) {
        document.getElementById('typeStreet').value = matches[0].replace(/[\[\]]/g, '');
        document.getElementById('streetNum').value = matches[1].replace(/[\[\]]/g, '');
        document.getElementById('numFirst').value = matches[2].replace(/[\[\]]/g, '');
        document.getElementById('numSecond').value = matches[3].replace(/[\[\]]/g, '');
    }
}