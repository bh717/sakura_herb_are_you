import axios from "axios";
import { ApiUrls } from "@/consts/ApiUrls";
import { BaseService } from "@/services/BaseService";

export class ProductService extends BaseService {
  constructor() {
    super();
  }

  async storeApi(search: any = {}): Promise<any> {
    console.log(search);
    return await this.post(ApiUrls.products(), search)
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
    return await this.get(ApiUrls.products(), search)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async showApi(id: number): Promise<any> {
    return await this.get(ApiUrls.products(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async updateApi(id: number, data: any): Promise<any> {
    return await this.put(ApiUrls.products(id), data)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async destroyApi(id: number): Promise<any> {
    return await this.delete(ApiUrls.products(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async categoryGroupStoreApi(data: any): Promise<any> {
    return await this.post(ApiUrls.productCategoryGroups(), data)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async categoryGroupIndexApi(): Promise<any> {
    return await this.get(ApiUrls.productCategoryGroups())
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async categoryGroupDestroyApi(id: number): Promise<any> {
    return await this.delete(ApiUrls.productCategoryGroups(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async categoryStoreApi(data: any): Promise<any> {
    return await this.post(ApiUrls.productCategories(), data)
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }

  async categoryDestroyApi(id: number): Promise<any> {
    return await this.delete(ApiUrls.productCategories(id))
      .then((response) => {
        return this.baseSuccess(response);
      })
      .catch((error) => {
        console.log(error.status);
        return this.baseError(error);
      });
  }
}
