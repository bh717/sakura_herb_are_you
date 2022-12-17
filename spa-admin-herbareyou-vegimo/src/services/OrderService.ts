import axios from "axios";
import { ApiUrls } from "@/consts/ApiUrls";
import { BaseService } from "@/services/BaseService";

export class OrderService extends BaseService {
  constructor() {
    super();
  }

  async indexApi(search: any = {}): Promise<any> {
    console.log(search);
    return await this.get(ApiUrls.orders(), search)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async showApi(id: number): Promise<any> {
    return await this.get(ApiUrls.orders(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async destroyApi(id: number): Promise<any> {
    return await this.delete(ApiUrls.orders(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async delivered(id: number): Promise<any> {
    return await this.put(ApiUrls.ordersDelivered(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }
}
