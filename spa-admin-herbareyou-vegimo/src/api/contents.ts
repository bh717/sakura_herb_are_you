import request from "@/utils/request";

export const storeContentAPi = (
  kind: string,
  content: string
): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}contents`,
    method: "post",
    data: {
      kind: kind,
      content: content,
    },
  });

export const firstContentApi = (kind: string): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}contents/firstContent/${kind}`,
    method: "get",
  });
