import axios from "axios";
import { ApiUrls } from "@/consts/ApiUrls";
import { BaseService } from "@/services/BaseService";

import store from "@/store/index";

// import { store } from '@/store/index';

export class AuthService extends BaseService {
  constructor() {
    super();
  }

  private saveAccessToken(accessToken: string): boolean {
    try {
      localStorage.setItem("access_token", accessToken);
      return true;
    } catch (error) {
      return false;
    }
  }

  // private deleteAccessToken(): void {
  //   localStorage.removeItem("access_token");
  // }

  // async loginApi(data: any): Promise<any> {
  //   return await this.post(ApiUrls.authLogin(), data)
  //     .then((response) => {
  //       return this.baseSuccess(response);
  //     })
  //     .catch((error) => {
  //       console.log(error.status);
  //       return this.baseError(error);
  //     });
  // }

  // async getMyDataApi(): Promise<any> {
  //   let headers = this.getBaseHeaders();
  //   headers.Authorization = "Bearer " + this.getAccessToken();
  //   return await axios
  //     .get(ApiUrls.authGetMyData(), {
  //       params: {},
  //       headers: headers,
  //       timeout: this.getTimeout(),
  //     })
  //     .then((response) => {
  //       return this.baseSuccess(response);
  //     })
  //     .catch((error) => {
  //       return this.baseError(error);
  //     });
  // }

  // async registApi(data: any = {}): Promise<any> {
  //   return await this.post(ApiUrls.authRegist(), data)
  //     .then((response) => {
  //       return this.baseSuccess(response);
  //     })
  //     .catch((error) => {
  //       return this.baseError(error);
  //     });
  // }

  // async updateApi(data: any = {}): Promise<any> {
  //   return await this.put(ApiUrls.authUpdate(), data)
  //     .then((response) => {
  //       return this.baseSuccess(response);
  //     })
  //     .catch((error) => {
  //       return this.baseError(error);
  //     });
  // }

  // async login(data: any = {}): Promise<any> {
  //   let loginApiResult = await this.loginApi(data);
  //   if (!loginApiResult.success) {
  //     return loginApiResult;
  //   }
  //   let isSuccess = this.saveAccessToken(loginApiResult.data.access_token);
  //   if (!isSuccess) {
  //     return {
  //       success: false,
  //       message: "ログインに失敗しました",
  //       status: null,
  //     };
  //   }
  //   await store.dispatch("setAuthData");
  //   return {
  //     success: store.state.isLogin,
  //     message: null,
  //     status: null,
  //   };
  // }

  // async resetPasswordUrlApi(email: string): Promise<any> {
  //   return await this.post(ApiUrls.resetPasswordUrl(), {
  //     email: email,
  //   })
  //     .then((response) => {
  //       return this.baseSuccess(response);
  //     })
  //     .catch((error) => {
  //       console.log(error.status);
  //       return this.baseError(error);
  //     });
  // }

  // async resetPasswordApi(password: string, code: string): Promise<any> {
  //   return await this.post(ApiUrls.resetPassword(), {
  //     password: password,
  //     code: code,
  //   })
  //     .then((response) => {
  //       return this.baseSuccess(response);
  //     })
  //     .catch((error) => {
  //       console.log(error.status);
  //       return this.baseError(error);
  //     });
  // }
}
