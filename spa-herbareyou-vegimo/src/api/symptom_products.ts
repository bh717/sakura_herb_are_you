import request from "@/utils/request";

export const showSymptomProduct = (id: string): Promise<any> =>
  request({
    url: `/symptomproduct/product/${id}`,
    method: "get",
  });
