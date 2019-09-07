export default class AES {
    constructor(mixed) {
        let splitted = this.decryptKeyAndIv(mixed).split(':');
        this.key = atob(splitted[0]);
        this.iv = atob(splitted[1]);
    }

    decryptKeyAndIv(mixed) {
        let asciis = [];
        let base64Decoded = atob(mixed);

        for (let i = 0; i < base64Decoded.length; i++) {
            asciis.push(base64Decoded[i].charCodeAt(0));
        }

        for (let i = 0; i <= asciis.length - 2; i = i + 2) {
            asciis[i] = asciis[i] ^ asciis[i + 1];
        }

        let result = "";
        for (let i = 0; i < asciis.length; i++) {
            result += String.fromCharCode(parseInt(asciis[i]))
        }

        return result;
    }

    str2ab(str) {
        const strLen = str.length;
        const buf = new ArrayBuffer(strLen);
        const bufView = new Uint8Array(buf);

        for (let i = 0; i < strLen; i++) {
            bufView[i] = str.charCodeAt(i);
        }

        return buf;
    }

    ab2str(buf) {
        return String.fromCharCode.apply(null, new Uint8Array(buf));
    }

    importKey() {
        return window.crypto.subtle.importKey(
            "raw",
            this.str2ab(this.key),
            "AES-CBC",
            false,
            ["encrypt", "decrypt"]
        );
    }

    decrypt(data) {
        let iKey = this.importKey();
        let iv = this.str2ab(this.iv);
        let dataBuf = this.str2ab(atob(data));
        let thisObj = this;

        return iKey.then(function(key) {
            return window.crypto.subtle.decrypt(
                {
                    name: "AES-CBC",
                    iv: iv
                },
                key,
                dataBuf
            ).then((decrypted) => {
                return JSON.parse(thisObj.ab2str(decrypted));
            });
        })
    }
};
