import request from "@/utils/request";

export const registAuthApi = (data: any = {}): Promise<any> =>
  request({
    url: "/auth/regist",
    method: "post",
    data: data,
  });

export const updateAuthApi = (data: any = {}): Promise<any> =>
  request({
    url: "/auth/update",
    method: "put",
    data: data,
  });

export const resetPasswordUrlApi = (email: string): Promise<any> =>
  request({
    url: "/auth/reset-password-url",
    method: "post",
    data: {
      email: email,
    },
  });

export const resetPasswordApi = (
  password: string,
  code: string
): Promise<any> =>
  request({
    url: "/auth/reset-password",
    method: "post",
    data: {
      password: password,
      code: code,
    },
  });

export const loginApi = (data: any): Promise<any> =>
  request({
    url: "/auth/login",
    method: "post",
    data: data,
  });

export const getMyDataApi = (): Promise<any> =>
  request({
    url: "/auth/getMyData",
    method: "get",
  });

//   logout(): boolean {
//   try {
//     localStorage.removeItem("access_token");
//     store.dispatch("deleteAuthData");
//     return true;
//   } catch (error) {
//     return false;
//   }
// }
