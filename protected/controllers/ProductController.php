<?php
/**
 * 
 */
class ProductController extends Controller {
    public function actionDetail($id) {
        $this->pageTitle = Yii::t('app', 'Detail');
        $productModel = new ShopProduct;
        $product = $productModel->model()->findByPk($id);
        $categoryModel = new ShopCategory;
        $this->breadcrumbs = $categoryModel->renderBreakcrumbs($product->category_id);
        $product = $productModel->formatProductDetail($product);
        $commentRates = array();
        $productRelations = $productModel->getProductRelations($product, 10);
        $this->render('detail', array('product' => $product, 'productRelations' => $productRelations, 'commentRates' => $commentRates));
	}
    
    public function actionCatalog($id) {
        $this->pageTitle = Yii::t('app', 'Catalog');
        $this->breadcrumbs = null;
        if(isset($_GET['page'])) {
            $params['page'] = $_GET['page'];
        }
        $params['sort'] = isset($_GET['sort']) ? $_GET['sort'] : 'buy';
        $params['title'] = isset($_GET['title']) ? $_GET['title'] : '';
        $params['id'] = $id;
        
        $categoryModel = new ShopCategory;
        $productModel = new ShopProduct;
        $categories = $categoryModel->model()->getAllById($id);
        $ids = $categoryModel->model()->getChildIds();
        $products = $productModel->model()->getAllByCategoryIds($ids);
        $manufacturers = $productModel->model()->getManufacturer($ids);
        $this->breadcrumbs = $categoryModel->renderBreakcrumbs($id);
        
        if(count($categories) > 1) {
		  $this->render('catalog/index', array('categories' => $categories, 'products' => $products, 'manufacturers' => $manufacturers, 'params' => $params));
        } else {
            $this->render('catalog/index_single', array('category' => $categories, 'products' => $products, 'manufacturers' => $manufacturers, 'params' => $params));
        }
	}
    
    public function actionManufacture($id, $mid) {
        $this->pageTitle = Yii::t('app', 'Manufacturer');
        $this->breadcrumbs = null;
        if(isset($_GET['page'])) {
            $params['page'] = $_GET['page'];
        }
        $params['sort'] = isset($_GET['sort']) ? $_GET['sort'] : 'buy';
        $params['name'] = isset($_GET['name']) ? $_GET['name'] : '';
        $params['id'] = $id;
        $params['mid'] = $mid;
        
        $categoryModel = new ShopCategory;
        $productModel = new ShopProduct;
        $categories = $categoryModel->model()->getAllById($id);
        $ids = $categoryModel->model()->getChildIds();
        $products = $productModel->model()->getProductByManufactureId($mid, $ids);
        $manufacturers = $productModel->model()->getManufacturer($ids);
        
        // Render Breakcrumbs manufacturer
        $breadcrumbs = $categoryModel->renderBreakcrumbs($id);
        foreach($manufacturers as $manufacturer) {
            if($manufacturer['id'] == $mid) {
                $breadcrumbs = array_merge($breadcrumbs, array($manufacturer['name']));
            }
        }
        $this->breadcrumbs = $breadcrumbs;
        
        if(count($categories) > 1) {
		  $this->render('manufacturer/index', array('categories' => $categories, 'products' => $products, 'manufacturers' => $manufacturers, 'params' => $params));
        } else {
            $this->render('manufacturer/index_single', array('category' => $categories, 'products' => $products, 'manufacturers' => $manufacturers, 'params' => $params));
        }
    }
    
    public function actionIndex($id) {
        $this->breadcrumbs = null;
        if(isset($_GET['page'])) {
            $params['page'] = $_GET['page'];
        }
        $params['id'] = $id;
        
        $categoryModel = new ShopCategory;
        $productModel = new ShopProduct;
        $categories = $categoryModel->model()->getAllById($id);
        $ids = $categoryModel->model()->getChildIds();
        $products = $productModel->model()->getAllByCategoryIds($ids);
        $this->breadcrumbs = $categoryModel->renderBreakcrumbs($id);
        if(count($categories) > 1) {
		  $this->render('catalog/index', array('categories' => $categories, 'products' => $products, 'params' => $params));
        } else {
            $this->render('catalog/index_single', array('category' => $categories, 'products' => $products, 'params' => $params));
        }
	}
    
    public function actionSearch() {
        $this->breadcrumbs = null;
        if(isset($_GET['page'])) {
            $params['page'] = $_GET['page'];
        }
        $params['sort'] = isset($_GET['sort']) ? $_GET['sort'] : 'buy';
        $params['search'] = isset($_GET['search']) ? $_GET['search'] : '';
        
        $productModel = new ShopProduct;
        $products = $productModel->searchProducts($_GET);
        
		$this->render('products', array('products' => $products, 'params' => $params));
	}
}