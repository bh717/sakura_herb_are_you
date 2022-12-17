export class ApiUrls {
  static getId(id: any | null): string {
    if (id === null) {
      return "";
    }
    return "/" + String(id);
  }

  static salesSaleData(): string {
    return process.env.VUE_APP_BASE_FARMER_API_V1_URL + "sales/saleData";
  }

  static authLogin(): string {
    return process.env.VUE_APP_BASE_FARMER_API_V1_URL + "auth/login";
  }

  static authGetMyData(): string {
    return process.env.VUE_APP_BASE_FARMER_API_V1_URL + "auth/getMyData";
  }

  static authUpdate(): string {
    return process.env.VUE_APP_BASE_FARMER_API_V1_URL + "auth/update";
  }

  static authRegist(): string {
    return process.env.VUE_APP_BASE_FARMER_API_V1_URL + "auth/regist";
  }

  static products(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL +
      "products" +
      ApiUrls.getId(id)
    );
  }

  static productCategoryGroups(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL +
      "product-category-groups" +
      ApiUrls.getId(id)
    );
  }

  static productCategories(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL +
      "product-categories" +
      ApiUrls.getId(id)
    );
  }

  static orders(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL + "orders" + ApiUrls.getId(id)
    );
  }

  static ordersDelivered(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL +
      "orders" +
      ApiUrls.getId(id) +
      "/delivered"
    );
  }

  static sales(id: number | null = null): string {
    return process.env.VUE_APP_BASE_FARMER_API_V1_URL + "sales";
  }

  static salesResettingResponsible(): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL + "sales/resetting-responsible"
    );
  }

  static companies(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL +
      "companies" +
      ApiUrls.getId(id)
    );
  }

  static users(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL + "users" + ApiUrls.getId(id)
    );
  }

  static comments(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL +
      "comments" +
      ApiUrls.getId(id)
    );
  }

  static colormeMapping(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL +
      "colorme-mappings" +
      ApiUrls.getId(id)
    );
  }

  static adminers(id: number | null = null): string {
    return (
      process.env.VUE_APP_BASE_FARMER_API_V1_URL +
      "adminers" +
      ApiUrls.getId(id)
    );
  }
}
