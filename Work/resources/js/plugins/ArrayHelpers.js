Array.prototype.deleteById = function (id) {
    for (let i = 0; i < this.length; i++) {
        if (this[i].id == id) {
            this.splice(i, 1);
            break;
        }
    }
}

Array.prototype.edit = function (data) {
    for (let i = 0; i < this.length; i++) {
        if (this[i].id == data.id) {
            for (let key of Object.keys(this[i])) {
                this[i][key] = data[key];
            }
            break;
        }
    }
}

Array.prototype.addToEnd = function (data) {
    this.unshift(data);
}