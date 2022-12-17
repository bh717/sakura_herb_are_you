import axios from "axios";

const service = axios.create({
  // baseURL: process.env.VUE_APP_HERBAREYOU_API_BASE_URL, // url = base url + request url
  timeout: 5000,
});

service.interceptors.request.use(
  (config) => {
    const accessToken = localStorage.getItem("access_token");
    if (accessToken !== undefined) {
      config.headers["Authorization"] = "Bearer " + accessToken;
    }
    return config;
  },
  (error) => {
    Promise.reject(error);
  }
);

service.interceptors.response.use(
  (response) => {
    let resultData: any = {
      data: response.data,
      status: response.status,
      success: true,
    };
    if (response.data.message) {
      resultData.message = response.data.message ?? "";
    }
    console.log(resultData);
    return resultData;
  },
  (error) => {
    let resultData: any = {
      status: error.response.status,
      success: false,
    };
    if (error.response.status === 422 && error.response?.data?.data) {
      resultData.data = error.response.data.data;
    }
    if (error.response.data.message) {
      resultData.message = error.response.data.message ?? "";
    }
    if (resultData.status === 500 && !resultData.message) {
      resultData.message =
        "サーバーエラーです。再度時間をおいてお試しください。";
    }
    console.log(resultData);
    return resultData;
  }
);

export default service;
