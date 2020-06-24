export default class Http {

    static requestGet(url, data)
    {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", url, true );
        xmlHttp.send( data );
        return xmlHttp.responseText;
    }

    static requestPost(url, data)
    {
        return this.makeRequest('POST', url, data);
    }

    static makeRequest(method, url, data) {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.open( method, url, true );
        xmlHttp.send( data );
        return xmlHttp.responseText;
    }
}