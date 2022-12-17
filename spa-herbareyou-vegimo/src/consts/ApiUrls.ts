export class ApiUrls {
  static getId(id: any | null): string {
    if (id === null) {
      return "";
    }
    return "/" + String(id);
  }

  static authLogin(): string {
    return process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "auth/login";
  }

  static authGetMyData(): string {
    return process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "auth/getMyData";
  }

  static authUpdate(): string {
    return process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "auth/update";
  }

  static authRegist(): string {
    return process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "auth/regist";
  }

  static products(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL +
      "products" +
      ApiUrls.getId(id)
    );
  }

  static categories(): string {
    return process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "products/categories";
  }

  static carts(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "carts" + ApiUrls.getId(id)
    );
  }

  static cartsAddCoupon(): string {
    return process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "carts/coupon";
  }

  static cartDetails(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL +
      "cart-details" +
      ApiUrls.getId(id)
    );
  }

  static cartDetailUpdateNum(id: number): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL +
      "cart-details" +
      ApiUrls.getId(id) +
      "/num"
    );
  }

  static cartDetailUpdateProductPrice(id: number): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL +
      "cart-details" +
      ApiUrls.getId(id) +
      "/product-price"
    );
  }

  static userDeliveryLocations(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL +
      "user-delivery-locations" +
      ApiUrls.getId(id)
    );
  }

  static orders(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "orders" + ApiUrls.getId(id)
    );
  }

  static ordersGetDeliveredAtList(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "orders/getDeliveredAtList"
    );
  }

  static orderDetails(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL +
      "order-details" +
      ApiUrls.getId(id)
    );
  }

  static resetPasswordUrl(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "auth/reset-password-url"
    );
  }

  static resetPassword(id: number | null = null): string {
    return process.env.VUE_APP_HERBAREYOU_API_BASE_URL + "auth/reset-password";
  }

  static inquiries(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL +
      "inquiries" +
      ApiUrls.getId(id)
    );
  }

  static therapistBlogs(id: number | null = null): string {
    return (
      process.env.VUE_APP_HERBAREYOU_API_BASE_URL +
      "therapist-blogs" +
      ApiUrls.getId(id)
    );
  }
}
