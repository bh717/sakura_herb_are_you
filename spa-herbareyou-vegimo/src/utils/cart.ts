
const KEY = 'cart_data';

// 例
// {
//   "product_prices": [
//     {
//       "id": 1,
//       "num": 1
//     }
//   ],
//   "coupon_code": "A-1"
// }

// export async function getCart(): Promise<any>
// {
//   let cartJson = localStorage.getItem(KEY);
//   if (!cartJson) {
//     return {
//       cart: null,
//       cart_details: [],
//       is_delete_product_price: [],
//     };
//   }
//   let apiResult = await showCartMineApi(JSON.parse(cartJson));
//   if (!apiResult.success) {
//     this.commonError(apiResult);
//     alert('カートの更新に失敗しました。このメッセージが続く場合はお問合せをお願いいたします。');
//     return;
//   }
//   localStorage.setItem(KEY, JSON.stringify(apiResult.data.cart_in_product_prices));
//   return apiResult.data;
// }

export function getCartData(): any
{
  let cartData = localStorage.getItem(KEY);
  if (!cartData) {
    return {
      product_prices: [],
      coupon_code: '',
    };
  }
  try {
    let data = JSON.parse(cartData);
    if (!data?.product_prices) {
      data.product_prices = [];
    }
    if (!data?.coupon_code) {
      data.coupon_code = '';
    }
    return data;
  } catch (error) {
    return {
      product_prices: [],
      coupon_code: '',
    };
  }
}

export function setProductPrice(productPrices: any[]): void
{
  let cartData = getCartData();
  cartData.product_prices = productPrices;
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
  return;
}

export function addProductPriceData(
  productPriceId: number,
  num: number
): void {
  let cartData = getCartData();

  console.log("started:", productPriceId);
  
  cartData.product_prices.push({
    id: productPriceId,
    num: num,
  });
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}

export function allDeleteProductPriceData(
): void {
  let cartData = getCartData();
  cartData.product_prices = [];
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}

export function setCouponCode(
  couponCode: string,
): void {
  let cartData = getCartData();
  cartData.coupon_code = couponCode;
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}

export function deleteCouponCode(
): void {
  let cartData = getCartData();
  cartData.coupon_code = '';
  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}

export function deleteProductPriceData(
  productPriceId: number
): void {
  let cartData = getCartData();
  for (let i = 0; i < cartData.product_prices.length; i++) {
    if (cartData.product_prices[i].id === productPriceId) {
      addProductPriceData(productPriceId, -1 * cartData.product_prices[i].num);
    }
  }
  return;

  localStorage.setItem(
    KEY,
    JSON.stringify(cartData)
  );
}
