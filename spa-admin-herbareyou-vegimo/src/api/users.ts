import request from "@/utils/request";

export const mailMagazineApi = (subject: string, body: string): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}users/mail-magazine`,
    method: "post",
    data: {
      subject: subject,
      body: body
    },
  });

  export const indexUserApi = (search: any = {}): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}users`,
    method: "get",
    params: search,
  });

export const showUserApi = (id: number): Promise<any> =>
  request({
    url: `${process.env.VUE_APP_HERBAREYOU_API_BASE_URL}users/${id}`,
    method: "get",
  });
