import axios from "axios";

export class BaseService {
  constructor() {}

  getAccessToken() {
    const accessToken = localStorage.getItem("access_token");
    if (accessToken === undefined) {
      return "";
    }
    return accessToken;
  }

  getBaseHeaders(): any {
    return {
      "Content-Type": "application/json",
    };
  }

  getHeaders(): any {
    let headers = this.getBaseHeaders();
    headers.Authorization = "Bearer " + this.getAccessToken();
    return headers;
  }

  getRandomString(num: number = 10): string {
    let S = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return Array.from(crypto.getRandomValues(new Uint8Array(num)))
      .map((n) => S[n % S.length])
      .join("");
  }

  ErrorMessage(error: any): void {
    if (error.response.data.message) {
      alert(error.response.data.message);
    }
  }

  baseError(error: any): any {
    console.log(error.response);
    let result: any = {
      success: false,
    };
    if (error.response.status) {
      result.status = error.response.status;
    } else {
      result.status = 500;
    }
    if (
      result.status === 422 &&
      error.response &&
      error.response.data &&
      error.response.data.data
    ) {
      result.data = error.response.data.data;
    }
    if (error.response && error.response.data && error.response.data.message) {
      result.message = error.response.data.message;
    }
    if (result.status === 500 && !result.message) {
      result.message = "サーバーエラーです。再度時間をおいてお試しください。";
    }
    return result;
  }

  baseSuccess(response: any): any {
    console.log(response);
    let result: any = {
      success: true,
    };
    if (response.data) {
      result.data = response.data;
    }
    return result;
  }

  get(url: string, params: any = {}): Promise<any> {
    return axios.get(url, {
      params: params,
      headers: this.getHeaders(),
      timeout: this.getTimeout(),
    });
  }

  post(url: string, data: any = {}): Promise<any> {
    return axios.post(url, data, {
      headers: this.getHeaders(),
      timeout: this.getTimeout(),
    });
  }

  put(url: string, data: any = {}): Promise<any> {
    return axios.put(url, data, {
      headers: this.getHeaders(),
      timeout: this.getTimeout(),
    });
  }

  delete(url: string): Promise<any> {
    return axios.delete(url, {
      headers: this.getHeaders(),
      timeout: this.getTimeout(),
    });
  }

  getTimeout(): number {
    return 3000;
  }
}
