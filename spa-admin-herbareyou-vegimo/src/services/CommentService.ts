import axios from "axios";
import { ApiUrls } from "@/consts/ApiUrls";
import { BaseService } from "@/services/BaseService";

export class CommentService extends BaseService {
  constructor() {
    super();
  }

  async storeApi(search: any = {}): Promise<any> {
    console.log(search);
    return await this.post(ApiUrls.comments(), search)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async indexApi(search: any = {}): Promise<any> {
    console.log(search);
    return await this.get(ApiUrls.comments(), search)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async showApi(id: number): Promise<any> {
    return await this.get(ApiUrls.comments(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async updateApi(id: number, data: any): Promise<any> {
    return await this.put(ApiUrls.comments(id), data)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async destroyApi(id: number): Promise<any> {
    return await this.delete(ApiUrls.comments(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }
}
