import request from "@/utils/request";

export const indexTasteApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}tastes`,
    method: "get",
  });

export const showTasteApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}tastes/${id}`,
    method: "get",
  });

export const storeTasteApi = (name: string, categoryNo: string): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}tastes`,
    method: "post",
    data: {
      name: name,
      category_no: categoryNo,
    },
  });

export const updateTasteApi = (
  id: number,
  name: string,
  categoryNo: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}tastes/${id}`,
    method: "put",
    data: {
      name: name,
      category_no: categoryNo,
    },
  });

export const destroyTasteApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}tastes/${id}`,
    method: "delete",
  });
