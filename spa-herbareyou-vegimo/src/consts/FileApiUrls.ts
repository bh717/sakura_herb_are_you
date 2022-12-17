export class FileApiUrls {
    static authLogin(): string {
        return Config.baseApiUrl + 'auth/login';
    }

    static uploadFile(hash: string | null = null): string {
        const stringId = hash === null ? '' : '/' + String(hash);
        return Config.baseFileApiUrl + 'uploadfiles' + stringId;
    }

    static uploadImage(hash: string | null = null): string {
        const stringId = hash === null ? '' : '/' + String(hash);
        return Config.baseFileApiUrl + 'uploadfiles/image' + stringId;
    }

    static showFile(hash: string): string {
        return Config.baseFileUrl + hash;
    }
}
