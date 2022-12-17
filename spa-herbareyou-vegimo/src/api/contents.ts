import request from "@/utils/request";

export const firstContentApi = (kind: string): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}contents/firstContent/${kind}`,
    method: "get",
  });

export const indexContentAboutApi = (): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}contents/about`,
    method: "get",
  });
