import request from "@/utils/request";

export const indexSymptomApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}symptoms`,
    method: "get",
  });

export const showSymptomApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}symptoms/${id}`,
    method: "get",
  });

export const storeSymptomApi = (
  name: string,
  categoryNo: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}symptoms`,
    method: "post",
    data: {
      name: name,
      category_no: categoryNo,
    },
  });

export const updateSymptomApi = (
  id: number,
  name: string,
  categoryNo: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}symptoms/${id}`,
    method: "put",
    data: {
      name: name,
      category_no: categoryNo,
    },
  });

export const destroySymptomApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}symptoms/${id}`,
    method: "delete",
  });
