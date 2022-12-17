import request from "@/utils/request";

export const indexTherapistApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapists`,
    method: "get",
  });

export const showTherapistApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapists/${id}`,
    method: "get",
  });

export const storeTherapistApi = (data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapists`,
    method: "post",
    data: data,
  });

export const updateTherapistApi = (id: number, data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapists/${id}`,
    method: "put",
    data: data,
  });

export const destroyTherapistApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapists/${id}`,
    method: "delete",
  });
