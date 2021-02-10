export default class Http {

    static async requestGet(url, data)
    {
        return await this.makeRequest('GET', url, data);
    }

    static async requestPost(url, data) {
        return await this.makeRequest('POST', url, data);
    }

    static makeRequest(method, url, data) {
        return new Promise(function (resolve, reject) {
            let xhr = new XMLHttpRequest();
            xhr.open(method, url);
            xhr.onload = function () {
                if (this.status === 200) {
                    resolve(JSON.parse(xhr.response));
                } else {
                    reject({
                        status: this.status,
                        statusText: xhr.statusText
                    });
                }
            };
            xhr.onerror = function () {
                reject({
                    status: this.status,
                    statusText: xhr.statusText
                });
            };
            xhr.send(data);
        });
    }
}