import request from "@/utils/request";

export const indexTherapistBlogApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapist-blogs`,
    method: "get",
  });

export const showTherapistBlogApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapist-blogs/${id}`,
    method: "get",
  });

export const storeTherapistBlogApi = (data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapist-blogs`,
    method: "post",
    data: data,
  });

export const updateTherapistBlogApi = (id: number, data: any): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapist-blogs/${id}`,
    method: "put",
    data: data,
  });

export const destroyTherapistBlogApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}therapist-blogs/${id}`,
    method: "delete",
  });
