import request from "@/utils/request";

export const indexMaterialApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}materials`,
    method: "get",
  });

export const showMaterialApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}materials/${id}`,
    method: "get",
  });

export const storeMaterialApi = (
  name: string,
  categoryNo: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}materials`,
    method: "post",
    data: {
      name: name,
      category_no: categoryNo,
    },
  });

export const updateMaterialApi = (
  id: number,
  name: string,
  categoryNo: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}materials/${id}`,
    method: "put",
    data: {
      name: name,
      category_no: categoryNo,
    },
  });

export const destroyMaterialApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}materials/${id}`,
    method: "delete",
  });
