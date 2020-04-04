export default class Http {

    static requestGet(url, data)
    {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", url, true );
        xmlHttp.send( data );
        return xmlHttp.responseText;
    }
}