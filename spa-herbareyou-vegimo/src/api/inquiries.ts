import request from "@/utils/request";

export const storeInquiryApi = (data: any): Promise<any> =>
  request({
    url: "/inquiries",
    method: "post",
    data: data,
  });
