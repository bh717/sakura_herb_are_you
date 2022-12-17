import request from "@/utils/request";

export const indexTerapistBlogApi = (search: any = {}): Promise<any> =>
  request({
    url: `/therapist-blogs`,
    method: "get",
    params: search,
  });

export const showTerapistBlogApi = (id: number): Promise<any> =>
  request({
    url: `/therapist-blogs/${id}`,
    method: "get",
  });
